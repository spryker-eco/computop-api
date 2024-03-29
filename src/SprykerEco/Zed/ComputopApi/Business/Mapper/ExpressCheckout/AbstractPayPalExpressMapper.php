<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractPayPalExpressMapper implements PayPalExpressMapperInterface
{
    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $computopApiConfig;

    /**
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $computopApiConfig
     */
    public function __construct(ComputopApiConfig $computopApiConfig)
    {
        $this->computopApiConfig = $computopApiConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string>
     */
    abstract protected function encryptRequestData(QuoteTransfer $quoteTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, string>
     */
    public function mapQuoteTransferToRequestArray(QuoteTransfer $quoteTransfer): array
    {
        $encryptedRequestData = $this->encryptRequestData($quoteTransfer);

        return [
            ComputopApiConstants::DATA => $encryptedRequestData[ComputopApiConstants::DATA],
            ComputopApiConstants::LENGTH => $encryptedRequestData[ComputopApiConstants::LENGTH],
            ComputopApiConstants::MERCHANT_ID => $this->computopApiConfig->getMerchantId(),
        ];
    }
}
