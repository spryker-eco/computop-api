<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\Init;

use Generated\Shared\Transfer\ComputopHeaderPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreInterface;
use SprykerEco\Zed\ComputopApi\Persistence\ComputopApiQueryContainerInterface;

abstract class AbstractInitMapper implements ApiInitMapperInterface
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
     * @var \SprykerEco\Zed\ComputopApi\Persistence\ComputopApiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    abstract public function getDataSubArray(TransferInterface $computopPaymentTransfer);

    /**
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    abstract protected function createPaymentTransfer();

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     * @param \SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreInterface $store
     * @param \SprykerEco\Zed\ComputopApi\Persistence\ComputopApiQueryContainerInterface $queryContainer
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $config,
        ComputopApiToStoreInterface $store,
        ComputopApiQueryContainerInterface $queryContainer
    ) {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
        $this->store = $store;
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    public function buildRequest(TransferInterface $computopPaymentTransfer)
    {
        $encryptedArray = $this->getEncryptedArray($computopPaymentTransfer);

        $data = $encryptedArray[ComputopApiConstants::DATA];
        $length = $encryptedArray[ComputopApiConstants::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    protected function getEncryptedArray(TransferInterface $computopPaymentTransfer)
    {
        $encryptedArray = $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($computopPaymentTransfer),
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
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function getComputopPaymentTransfer(QuoteTransfer $quoteTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $computopPaymentTransfer = $this->createPaymentTransfer();
        $computopPaymentTransfer->fromArray($computopHeaderPayment->toArray(), true);
        $computopPaymentTransfer->setMerchantId($this->config->getMerchantId());
        $computopPaymentTransfer->setCurrency($this->store->getCurrencyIsoCode());

        $computopPaymentTransfer->setMac(
            $this->computopApiService->getMacEncryptedValue($computopPaymentTransfer)
        );

        $paymentEntity = $this->getPaymentEntity($computopHeaderPayment->getTransId());
        $computopPaymentTransfer->setReqId($paymentEntity->getReqId());
        $computopPaymentTransfer->setRefNr($paymentEntity->getReference());

        return $computopPaymentTransfer;
    }

    /**
     * @param $transactionId
     *
     * @return \Orm\Zed\Computop\Persistence\SpyPaymentComputop
     */
    protected function getPaymentEntity($transactionId)
    {
        return $this->queryContainer->queryPaymentByTransactionId($transactionId)->findOne();
    }
}
