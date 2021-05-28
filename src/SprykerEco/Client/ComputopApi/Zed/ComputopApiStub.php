<?php

namespace SprykerEco\Client\ComputopApi\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;

class ComputopApiStub extends ZedRequestStub implements ComputopApiStubInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function sendPayPalExpressPrepareRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->zedStub->call('/computop-api/gateway/send-pay-pal-express-prepare', $quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function sendPayPalExpressCompleteRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->zedStub->call('/computop-api/gateway/send-pay-pal-express-complete', $quoteTransfer);
    }
}
