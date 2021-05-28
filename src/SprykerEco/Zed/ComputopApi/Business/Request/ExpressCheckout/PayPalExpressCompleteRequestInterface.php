<?php

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;

interface PayPalExpressCompleteRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function request(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
