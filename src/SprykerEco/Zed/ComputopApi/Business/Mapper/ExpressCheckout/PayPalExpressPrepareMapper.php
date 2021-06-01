<?php

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;

class PayPalExpressPrepareMapper extends AbstractPayPalExpressMapper
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    protected function encryptRequestData(QuoteTransfer $quoteTransfer): array
    {
        $computopPayPalExpressPaymentTransfer = $quoteTransfer->getPayment()->getComputopPayPalExpress();

        return [
            ComputopApiConstants::DATA => $computopPayPalExpressPaymentTransfer->getData(),
            ComputopApiConstants::LENGTH => $computopPayPalExpressPaymentTransfer->getLen(),
        ];
    }
}
