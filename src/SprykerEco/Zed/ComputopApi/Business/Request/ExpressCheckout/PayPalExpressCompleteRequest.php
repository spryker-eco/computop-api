<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;

class PayPalExpressCompleteRequest extends AbstractPayPalExpressRequest implements PayPalExpressCompleteRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function request(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $requestData = $this->mapper->buildRequest($quoteTransfer);
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer $computopApiPayPalExpressCompleteResponseTransfer */
        $computopApiPayPalExpressCompleteResponseTransfer = $this->sendRequest($requestData);
        $quoteTransfer
            ->getPayment()
            ->getComputopPayPalExpress()
            ->setPayPalExpressCompleteResponse($computopApiPayPalExpressCompleteResponseTransfer);

        return $quoteTransfer;
    }
}
