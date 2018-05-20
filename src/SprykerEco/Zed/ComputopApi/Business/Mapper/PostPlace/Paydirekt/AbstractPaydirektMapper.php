<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt;

use Generated\Shared\Transfer\ComputopPaydirektPaymentTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\AbstractPostPlaceMapper;

abstract class AbstractPaydirektMapper extends AbstractPostPlaceMapper
{
    /**
     * @return string
     */
    public function getMethodName()
    {
        return ComputopApiConfig::PAYMENT_METHOD_PAYDIREKT;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopPaydirektPaymentTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer)
    {
        return new ComputopPaydirektPaymentTransfer();
    }
}
