<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\Traits;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

trait AuthorizeMapperTrait
{
    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer): array
    {
        $dataSubArray[ComputopApiConfig::PAY_ID] = $computopApiRequestTransfer->getPayId();
        $dataSubArray[ComputopApiConfig::TRANS_ID] = $computopApiRequestTransfer->getTransId();
        $dataSubArray[ComputopApiConfig::REQ_ID] = $computopApiRequestTransfer->getReqId();
        $dataSubArray[ComputopApiConfig::REF_NR] = $computopApiRequestTransfer->getRefNr();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $computopApiRequestTransfer->getAmount();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $computopApiRequestTransfer->getCurrency();
        $dataSubArray[ComputopApiConfig::CAPTURE] = $computopApiRequestTransfer->getCapture();
        $dataSubArray[ComputopApiConfig::MAC] = $computopApiRequestTransfer->getMac();
        $dataSubArray[ComputopApiConfig::ORDER_DESC] = $computopApiRequestTransfer->getOrderDesc();

        return $dataSubArray;
    }

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    protected function getOrderDesc(
        ComputopApiServiceInterface $computopApiService,
        OrderTransfer $orderTransfer
    ): string {
        return $computopApiService->getDescriptionValue(
            $orderTransfer->getItems()->getArrayCopy()
        );
    }
}
