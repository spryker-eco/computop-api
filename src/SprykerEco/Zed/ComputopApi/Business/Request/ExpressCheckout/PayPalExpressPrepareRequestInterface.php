<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;

interface PayPalExpressPrepareRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendRequest(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
