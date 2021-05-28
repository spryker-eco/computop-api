<?php

namespace SprykerEco\Client\ComputopApi;

use Generated\Shared\Transfer\QuoteTransfer;

/**
 * @method \SprykerEco\Client\Computop\ComputopFactory getFactory()
 */
interface ComputopApiClientInterface
{
    /**
     * Specification:
     *  - Send PayPal Express prepare request to Computop API.
     *
     * @api
     *
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function sendPayPalExpressPrepareRequest(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * Specification:
     *  - Send PayPal Express complete request to Computop API.
     *
     * @api
     *
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function sendPayPalExpressCompleteRequest(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
