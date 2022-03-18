<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;

class PayPalExpressPrepareMapper extends AbstractPayPalExpressMapper
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, int|string|null>
     */
    protected function encryptRequestData(QuoteTransfer $quoteTransfer): array
    {
        $computopPayPalExpressPaymentTransfer = $quoteTransfer->getPaymentOrFail()->getComputopPayPalExpressOrFail();

        return [
            ComputopApiConstants::DATA => $computopPayPalExpressPaymentTransfer->getData(),
            ComputopApiConstants::LENGTH => $computopPayPalExpressPaymentTransfer->getLen(),
        ];
    }
}
