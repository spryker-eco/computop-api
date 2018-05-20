<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\Traits;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

trait RefundMapperTrait
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    public function getDataSubArray(TransferInterface $computopPaymentTransfer)
    {
        $dataSubArray[ComputopApiConfig::PAY_ID] = $computopPaymentTransfer->getPayId();
        $dataSubArray[ComputopApiConfig::TRANS_ID] = $computopPaymentTransfer->getTransId();
        $dataSubArray[ComputopApiConfig::REQ_ID] = $computopPaymentTransfer->getReqId();
        $dataSubArray[ComputopApiConfig::REF_NR] = $computopPaymentTransfer->getRefNr();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $computopPaymentTransfer->getAmount();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $computopPaymentTransfer->getCurrency();
        $dataSubArray[ComputopApiConfig::MAC] = $computopPaymentTransfer->getMac();

        return $dataSubArray;
    }
}
