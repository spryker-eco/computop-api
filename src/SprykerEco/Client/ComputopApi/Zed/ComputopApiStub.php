<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopApi\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Client\ComputopApi\Dependency\Client\ComputopApiToZedRequestClientInterface;

class ComputopApiStub implements ComputopApiStubInterface
{
    /**
     * @var \SprykerEco\Client\ComputopApi\Dependency\Client\ComputopApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \SprykerEco\Client\ComputopApi\Dependency\Client\ComputopApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ComputopApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @uses \SprykerEco\Zed\ComputopApi\Communication\Controller\GatewayController::performPayPalExpressPrepareApiCallAction()
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressPrepareRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer */
        $quoteTransfer = $this
            ->zedRequestClient
            ->call('/computop-api/gateway/perform-pay-pal-express-prepare-api-call', $quoteTransfer);

        return $quoteTransfer;
    }

    /**
     * @uses \SprykerEco\Zed\ComputopApi\Communication\Controller\GatewayController::performPayPalExpressCompleteApiCallAction()
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressCompleteRequest(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer */
        $quoteTransfer = $this
            ->zedRequestClient
            ->call('/computop-api/gateway/perform-pay-pal-express-complete-api-call', $quoteTransfer);

        return $quoteTransfer;
    }
}
