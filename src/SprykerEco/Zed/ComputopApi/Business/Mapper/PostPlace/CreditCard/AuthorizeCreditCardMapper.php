<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\Traits\AuthorizeMapperTrait;

class AuthorizeCreditCardMapper extends AbstractCreditCardMapper
{
    use AuthorizeMapperTrait;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer): ComputopApiRequestTransfer
    {
        $computopApiRequestTransfer = parent::createPaymentTransfer($orderTransfer);
        $computopApiRequestTransfer->setCapture(
            $this->getCaptureType(ComputopApiConfig::PAYMENT_METHOD_CREDIT_CARD),
        );
        $computopApiRequestTransfer->setOrderDesc($this->getOrderDesc($this->computopApiService, $orderTransfer));

        return $computopApiRequestTransfer;
    }
}
