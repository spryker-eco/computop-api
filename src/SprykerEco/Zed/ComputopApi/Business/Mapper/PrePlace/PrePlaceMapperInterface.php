<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace;

use Generated\Shared\Transfer\ComputopHeaderPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface;

interface PrePlaceMapperInterface extends MapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return array
     */
    public function buildRequest(QuoteTransfer $quoteTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment);
}
