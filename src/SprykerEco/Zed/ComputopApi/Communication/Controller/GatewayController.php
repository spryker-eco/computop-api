<?php

namespace SprykerEco\Zed\ComputopApi\Communication\Controller;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerEco\Zed\ComputopApi\Business\ComputopApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressPrepareAction(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->performPayPalExpressPrepareApiCall($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sendPayPalExpressCompleteAction(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->performPayPalExpressCompleteApiCall($quoteTransfer);
    }
}
