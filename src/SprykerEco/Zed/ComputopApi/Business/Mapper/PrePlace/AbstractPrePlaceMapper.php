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
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface;

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
     * @var \SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    abstract public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer);

    /**
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(): ComputopApiRequestTransfer
    {
        return new ComputopApiRequestTransfer();
    }

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     * @param \SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface $storeFacade
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $config,
        ComputopApiToStoreFacadeInterface $storeFacade
    ) {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    public function buildRequest(
        QuoteTransfer $quoteTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): array {
        $encryptedRequestData = $this->encryptRequestData($quoteTransfer, $computopApiHeaderPayment);

        $data = $encryptedRequestData[ComputopApiConstants::DATA];
        $length = $encryptedRequestData[ComputopApiConstants::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    protected function encryptRequestData(
        QuoteTransfer $quoteTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): array {
        $computopApiPaymentTransfer = $this->getComputopPaymentTransfer($quoteTransfer, $computopApiHeaderPayment);

        return $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($computopApiPaymentTransfer),
            $this->config->getBlowfishPass(),
        );
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
        $computopApiPaymentTransfer->setCurrency($this->storeFacade->getCurrentStore()->getSelectedCurrencyIsoCode());

        $computopApiPaymentTransfer->setMac(
            $this->computopApiService->generateEncryptedMac($computopApiPaymentTransfer),
        );

        $computopApiPaymentTransfer->setReqId($this->computopApiService->generateReqIdFromQuoteTransfer($quoteTransfer));
        $computopApiPaymentTransfer->setRefNr($quoteTransfer->getOrderReference());

        return $computopApiPaymentTransfer;
    }
}
