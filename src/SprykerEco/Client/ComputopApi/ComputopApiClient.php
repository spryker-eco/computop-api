<?php

namespace SprykerEco\Client\ComputopApi;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerEco\Client\ComputopApi\ComputopApiFactory getFactory()
 */
class ComputopApiClient extends AbstractClient implements ComputopApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     */
    public function sendPayPalExpressPrepareRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createZedStub()->sendPayPalExpressPrepareRequest($quoteTransfer);
    }

    /**
     * @inheritDoc
     *
     * @api
     */
    public function sendPayPalExpressCompleteRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createZedStub()->sendPayPalExpressCompleteRequest($quoteTransfer);
    }
}
