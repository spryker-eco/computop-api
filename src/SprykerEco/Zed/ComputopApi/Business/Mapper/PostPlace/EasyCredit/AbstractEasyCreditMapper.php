<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit;

use DateTime;
use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\AbstractPostPlaceMapper;

abstract class AbstractEasyCreditMapper extends AbstractPostPlaceMapper
{
    /**
     * @var string
     */
    protected const DATE_TIME_FORMAT = 'Y-m-d';

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return ComputopApiConfig::PAYMENT_METHOD_EASY_CREDIT;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer): ComputopApiRequestTransfer
    {
        $computopApiRequestTransfer = new ComputopApiRequestTransfer();
        $dateTime = new DateTime($orderTransfer->getCreatedAtOrFail());
        $computopApiRequestTransfer->setDate($dateTime->format(static::DATE_TIME_FORMAT));

        return $computopApiRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer): array
    {
        return [
            ComputopApiConstants::PAY_ID => $computopApiRequestTransfer->getPayId(),
            ComputopApiConstants::TRANS_ID => $computopApiRequestTransfer->getTransId(),
            ComputopApiConstants::REQ_ID => $computopApiRequestTransfer->getReqId(),
            ComputopApiConstants::REF_NR => $computopApiRequestTransfer->getRefNr(),
            ComputopApiConstants::AMOUNT => $computopApiRequestTransfer->getAmount(),
            ComputopApiConstants::CURRENCY => $computopApiRequestTransfer->getCurrency(),
            ComputopApiConstants::MAC => $computopApiRequestTransfer->getMac(),
        ];
    }
}
