<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

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
    protected $computopApiConfig;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $computopApiConfig
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $computopApiConfig
    ) {
        $this->computopApiService = $computopApiService;
        $this->computopApiConfig = $computopApiConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string[]
     */
    abstract protected function encryptRequestData(QuoteTransfer $quoteTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string[]
     */
    public function buildRequest(QuoteTransfer $quoteTransfer): array
    {
        $encryptedRequestData = $this->encryptRequestData($quoteTransfer);

        return [
            ComputopApiConstants::DATA => $encryptedRequestData[ComputopApiConstants::DATA],
            ComputopApiConstants::LENGTH => $encryptedRequestData[ComputopApiConstants::LENGTH],
            ComputopApiConstants::MERCHANT_ID => $this->computopApiConfig->getMerchantId(),
        ];
    }
}
