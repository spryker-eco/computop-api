<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as SharedComputopApiConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractRiskCheckMapper implements ApiRiskCheckMapperInterface
{
    /**
     * @var int
     */
    protected const TRANS_ID_LIMIT = 64;

    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected $computopApiService;

    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    abstract public function getDataSubArray(QuoteTransfer $quoteTransfer, ComputopApiRequestTransfer $requestTransfer);

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $config
    ) {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string>
     */
    public function buildRequest(QuoteTransfer $quoteTransfer): array
    {
        $requestTransfer = $this->createComputopApiRequestTransfer($quoteTransfer);
        $encryptedArray = $this->encryptRequestData($quoteTransfer, $requestTransfer);

        $data = $encryptedArray[SharedComputopApiConfig::DATA];
        $length = $encryptedArray[SharedComputopApiConfig::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return array<string>
     */
    protected function encryptRequestData(
        QuoteTransfer $quoteTransfer,
        ComputopApiRequestTransfer $requestTransfer
    ): array {
        return $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($quoteTransfer, $requestTransfer),
            $this->config->getBlowfishPass(),
        );
    }

    /**
     * @param string $data
     * @param string $length
     * @param string $merchantId
     *
     * @return array<string>
     */
    protected function buildRequestData($data, $length, $merchantId): array
    {
        return [
            SharedComputopApiConfig::DATA => $data,
            SharedComputopApiConfig::LENGTH => $length,
            SharedComputopApiConfig::MERCHANT_ID => $merchantId,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createComputopApiRequestTransfer(QuoteTransfer $quoteTransfer): ComputopApiRequestTransfer
    {
        return (new ComputopApiRequestTransfer())
            ->setPayId('')
            ->setMerchantId($this->config->getMerchantId())
            ->setTransId($this->computopApiService->generateLimitedTransId($quoteTransfer, static::TRANS_ID_LIMIT))
            ->setAmount($quoteTransfer->getTotalsOrFail()->getPriceToPay())
            ->setCurrency($quoteTransfer->getCurrencyOrFail()->getCode())
            ->setOrderDesc($this->computopApiService->getDescriptionValue($quoteTransfer->getItems()->getArrayCopy()));
    }
}
