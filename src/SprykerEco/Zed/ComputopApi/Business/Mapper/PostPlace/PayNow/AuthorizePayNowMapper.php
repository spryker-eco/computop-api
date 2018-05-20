<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow;

use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\Traits\AuthorizeMapperTrait;

class AuthorizePayNowMapper extends AbstractPayNowMapper
{
    use AuthorizeMapperTrait;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopPayNowPaymentTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer)
    {
        $computopPaymentTransfer = parent::createPaymentTransfer($orderTransfer);
        $computopPaymentTransfer->setCapture(ComputopApiConfig::CAPTURE_MANUAL_TYPE);
        $computopPaymentTransfer->setOrderDesc($this->getOrderDesc($this->computopApiService, $orderTransfer));

        return $computopPaymentTransfer;
    }
}
