<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface;

interface PrePlaceMapperInterface extends MapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return array
     */
    public function buildRequest(QuoteTransfer $quoteTransfer, ComputopApiHeaderPaymentTransfer $computopHeaderPayment);
}
