<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit;

use DateTime;
use Generated\Shared\Transfer\ComputopEasyCreditPaymentTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
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
     * @return \Generated\Shared\Transfer\ComputopEasyCreditPaymentTransfer
     */
    protected function createPaymentTransfer(OrderTransfer $orderTransfer)
    {
        $computopEasyCreditTransfer = new ComputopEasyCreditPaymentTransfer();
        $dateTime = new DateTime($orderTransfer->getCreatedAt());
        $computopEasyCreditTransfer->setDate($dateTime->format(self::DATE_TIME_FORMAT));

        return $computopEasyCreditTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    public function getDataSubArray(TransferInterface $computopPaymentTransfer)
    {
        /** @var \Generated\Shared\Transfer\ComputopEasyCreditPaymentTransfer $computopPaymentTransfer */
        $dataSubArray[ComputopApiConstants::PAY_ID] = $computopPaymentTransfer->getPayId();
        $dataSubArray[ComputopApiConstants::TRANS_ID] = $computopPaymentTransfer->getTransId();
        $dataSubArray[ComputopApiConstants::REQ_ID] = $computopPaymentTransfer->getReqId();
        $dataSubArray[ComputopApiConstants::REF_NR] = $computopPaymentTransfer->getRefNr();
        $dataSubArray[ComputopApiConstants::AMOUNT] = $computopPaymentTransfer->getAmount();
        $dataSubArray[ComputopApiConstants::CURRENCY] = $computopPaymentTransfer->getCurrency();
        $dataSubArray[ComputopApiConstants::MAC] = $computopPaymentTransfer->getMac();

        return $dataSubArray;
    }
}
