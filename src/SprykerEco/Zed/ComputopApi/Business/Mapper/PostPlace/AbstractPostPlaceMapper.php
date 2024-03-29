<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface;

abstract class AbstractPostPlaceMapper implements PostPlaceMapperInterface
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
    abstract public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    abstract protected function createPaymentTransfer(OrderTransfer $orderTransfer);

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
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    public function buildRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): array {
        $encryptedArray = $this->encryptRequestData($orderTransfer, $computopApiHeaderPayment);

        $data = $encryptedArray[ComputopApiConstants::DATA];
        $length = $encryptedArray[ComputopApiConstants::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return array
     */
    protected function encryptRequestData(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): array {
        $computopApiRequestTransfer = $this->getComputopPaymentTransfer($orderTransfer, $computopApiHeaderPayment);

        return $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($computopApiRequestTransfer),
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
    protected function buildRequestData($data, $length, $merchantId): array
    {
        $requestData = [
            ComputopApiConstants::DATA => $data,
            ComputopApiConstants::LENGTH => $length,
            ComputopApiConstants::MERCHANT_ID => $merchantId,
        ];

        return $requestData;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function getComputopPaymentTransfer(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): ComputopApiRequestTransfer {
        $computopApiRequestTransfer = $this->createPaymentTransfer($orderTransfer);
        $computopApiRequestTransfer->fromArray($computopApiHeaderPayment->toArray(), true);
        $computopApiRequestTransfer->setMerchantId($this->config->getMerchantId());
        $computopApiRequestTransfer->setCurrency($this->storeFacade->getCurrentStore()->getSelectedCurrencyIsoCode());

        $computopApiRequestTransfer->setMac(
            $this->computopApiService->generateEncryptedMac($computopApiRequestTransfer),
        );
        $computopApiRequestTransfer->setReqId($this->computopApiService->generateReqIdFromOrderTransfer($orderTransfer));
        $computopApiRequestTransfer->setRefNr($orderTransfer->getOrderReference());

        return $computopApiRequestTransfer;
    }

    /**
     * @param string $method
     *
     * @return string
     */
    protected function getCaptureType(string $method): string
    {
        $paymentMethodsCaptureTypes = $this->config->getPaymentMethodsCaptureTypes();

        return $paymentMethodsCaptureTypes[$method] ?? '';
    }
}
