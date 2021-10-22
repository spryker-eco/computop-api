<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;

interface PayPalExpressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, string>
     */
    public function mapQuoteTransferToRequestArray(QuoteTransfer $quoteTransfer): array;
}
