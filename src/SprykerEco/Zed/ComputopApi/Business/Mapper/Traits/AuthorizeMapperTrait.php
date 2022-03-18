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
        return [
            ComputopApiConfig::PAY_ID => $computopApiRequestTransfer->getPayId(),
            ComputopApiConfig::TRANS_ID => $computopApiRequestTransfer->getTransId(),
            ComputopApiConfig::REQ_ID => $computopApiRequestTransfer->getReqId(),
            ComputopApiConfig::REF_NR => $computopApiRequestTransfer->getRefNr(),
            ComputopApiConfig::AMOUNT => $computopApiRequestTransfer->getAmount(),
            ComputopApiConfig::CURRENCY => $computopApiRequestTransfer->getCurrency(),
            ComputopApiConfig::CAPTURE => $computopApiRequestTransfer->getCapture(),
            ComputopApiConfig::MAC => $computopApiRequestTransfer->getMac(),
            ComputopApiConfig::ORDER_DESC => $computopApiRequestTransfer->getOrderDesc(),
        ];
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
            $orderTransfer->getItems()->getArrayCopy(),
        );
    }
}
