<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\Traits;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

trait InquireMapperTrait
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
            ComputopApiConfig::MAC => $computopApiRequestTransfer->getMac(),
        ];
    }
}
