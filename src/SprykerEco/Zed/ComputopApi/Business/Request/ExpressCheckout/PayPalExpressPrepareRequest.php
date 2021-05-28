<?php

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PayPalExpressPrepareRequest extends AbstractPayPalExpressRequest implements PayPalExpressPrepareRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function request(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $requestData = $this->mapper->buildRequest($quoteTransfer);
        /** @var ComputopApiPayPalExpressPrepareResponseTransfer $computopApiPayPalExpressPrepareResponseTransfer */
        $computopApiPayPalExpressPrepareResponseTransfer = $this->sendRequest($requestData);
        $quoteTransfer
            ->getPayment()
            ->getComputopPayPalExpress()
            ->setPayPalExpressPrepareResponse($computopApiPayPalExpressPrepareResponseTransfer);

        return $quoteTransfer;
    }
}
