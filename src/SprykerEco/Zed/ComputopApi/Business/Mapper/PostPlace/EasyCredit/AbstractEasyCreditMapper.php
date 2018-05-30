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
    const DATE_TIME_FORMAT = 'Y-m-d';

    /**
     * @return string
     */
    public function getMethodName()
    {
        return ComputopApiConfig::PAYMENT_METHOD_EASY_CREDIT;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiRequestTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer)
    {
        $computopApiRequestTransfer = new ComputopApiRequestTransfer();
        $dateTime = new DateTime($orderTransfer->getCreatedAt());
        $computopApiRequestTransfer->setDate($dateTime->format(self::DATE_TIME_FORMAT));

        return $computopApiRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer)
    {
        $dataSubArray[ComputopApiConstants::PAY_ID] = $computopApiRequestTransfer->getPayId();
        $dataSubArray[ComputopApiConstants::TRANS_ID] = $computopApiRequestTransfer->getTransId();
        $dataSubArray[ComputopApiConstants::REQ_ID] = $computopApiRequestTransfer->getReqId();
        $dataSubArray[ComputopApiConstants::REF_NR] = $computopApiRequestTransfer->getRefNr();
        $dataSubArray[ComputopApiConstants::AMOUNT] = $computopApiRequestTransfer->getAmount();
        $dataSubArray[ComputopApiConstants::CURRENCY] = $computopApiRequestTransfer->getCurrency();
        $dataSubArray[ComputopApiConstants::MAC] = $computopApiRequestTransfer->getMac();

        return $dataSubArray;
    }
}
