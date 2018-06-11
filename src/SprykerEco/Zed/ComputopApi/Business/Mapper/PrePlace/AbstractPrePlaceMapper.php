<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreInterface;

abstract class AbstractPrePlaceMapper implements PrePlaceMapperInterface
{
    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected $computopApiService;

    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @var \SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreInterface
     */
    protected $store;

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    abstract public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer);

    /**
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    abstract protected function createPaymentTransfer();

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     * @param \SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreInterface $store
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $config,
        ComputopApiToStoreInterface $store
    ) {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
        $this->store = $store;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    public function buildRequest(QuoteTransfer $quoteTransfer, ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment)
    {
        $encryptedArray = $this->getEncryptedArray($quoteTransfer, $computopApiHeaderPayment);

        $data = $encryptedArray[ComputopApiConstants::DATA];
        $length = $encryptedArray[ComputopApiConstants::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    protected function getEncryptedArray(QuoteTransfer $quoteTransfer, ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment)
    {
        $computopApiPaymentTransfer = $this->getComputopPaymentTransfer($quoteTransfer, $computopApiHeaderPayment);

        $encryptedArray = $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($computopApiPaymentTransfer),
            $this->config->getBlowfishPass()
        );

        return $encryptedArray;
    }

    /**
     * @param string $data
     * @param string $length
     * @param string $merchantId
     *
     * @return array
     */
    protected function buildRequestData($data, $length, $merchantId)
    {
        $requestData = [
            ComputopApiConstants::DATA => $data,
            ComputopApiConstants::LENGTH => $length,
            ComputopApiConstants::MERCHANT_ID => $merchantId,
        ];

        return $requestData;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function getComputopPaymentTransfer(QuoteTransfer $quoteTransfer, ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment)
    {
        $computopApiPaymentTransfer = $this->createPaymentTransfer();
        $computopApiPaymentTransfer->fromArray($computopApiHeaderPayment->toArray(), true);
        $computopApiPaymentTransfer->setMerchantId($this->config->getMerchantId());
        $computopApiPaymentTransfer->setCurrency($this->store->getCurrencyIsoCode());

        $computopApiPaymentTransfer->setMac(
            $this->computopApiService->getMacEncryptedValue($computopApiPaymentTransfer)
        );

        $computopApiPaymentTransfer->setReqId($this->computopApiService->generateReqId($quoteTransfer));
        $computopApiPaymentTransfer->setRefNr($quoteTransfer->getOrderReference());

        return $computopApiPaymentTransfer;
    }
}
