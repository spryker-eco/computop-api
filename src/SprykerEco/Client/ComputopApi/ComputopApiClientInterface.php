<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopApi;

use Generated\Shared\Transfer\QuoteTransfer;

/**
 * @method \SprykerEco\Client\Computop\ComputopFactory getFactory()
 */
interface ComputopApiClientInterface
{
    /**
     * Specification:
     *  - Makes Zed request.
     *  - Sends a PayPal Express prepare request to Computop API.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressPrepareRequest(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * Specification:
     *  - Makes Zed request.
     *  - Sends PayPal Express complete request to Computop API.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressCompleteRequest(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
