<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;

class PayPalExpressPrepareRequest extends AbstractPayPalExpressRequest implements PayPalExpressPrepareRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $requestData = $this->payPalExpressMapper->buildRequest($quoteTransfer);
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer $computopApiPayPalExpressPrepareResponseTransfer */
        $computopApiPayPalExpressPrepareResponseTransfer = $this->send($requestData);
        $quoteTransfer
            ->getPayment()
            ->getComputopPayPalExpress()
            ->setPayPalExpressPrepareResponse($computopApiPayPalExpressPrepareResponseTransfer);

        return $quoteTransfer;
    }
}
