<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\AbstractPostPlaceMapper;

abstract class AbstractDirectDebitMapper extends AbstractPostPlaceMapper
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return ComputopApiConfig::PAYMENT_METHOD_DIRECT_DEBIT;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer): ComputopApiRequestTransfer
    {
        return new ComputopApiRequestTransfer();
    }
}
