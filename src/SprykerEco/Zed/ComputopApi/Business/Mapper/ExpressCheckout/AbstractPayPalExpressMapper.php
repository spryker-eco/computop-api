<?php

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractPayPalExpressMapper implements PayPalExpressMapperInterface
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
     * @param QuoteTransfer $quoteTransfer
     * @return array
     */
    abstract public function encryptRequestData(QuoteTransfer $quoteTransfer): array;

    /**
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(): ComputopApiRequestTransfer
    {
        return new ComputopApiRequestTransfer();
    }

    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $config
    )
    {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return array|string[]
     */
    public function buildRequest(QuoteTransfer $quoteTransfer): array
    {
        $encryptedRequestData = $this->encryptRequestData($quoteTransfer);

        $data = $encryptedRequestData[ComputopApiConstants::DATA];
        $length = $encryptedRequestData[ComputopApiConstants::LENGTH];
        $merchantId = $this->config->getMerchantId();

        return $this->buildRequestData($data, $length, $merchantId);
    }


    /**
     * @param string $data
     * @param string $length
     * @param string $merchantId
     *
     * @return array
     */
    protected function buildRequestData(string $data, string $length, string $merchantId): array
    {
        $requestData = [
            ComputopApiConstants::DATA => $data,
            ComputopApiConstants::LENGTH => $length,
            ComputopApiConstants::MERCHANT_ID => $merchantId,
        ];

        return $requestData;
    }
}
