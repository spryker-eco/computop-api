<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\EasyCredit;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\AbstractPrePlaceMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;

class StatusEasyCreditMapper extends AbstractPrePlaceMapper implements PrePlaceMapperInterface
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
            ComputopApiConfig::MAC => $computopApiRequestTransfer->getMac(),
            ComputopApiConfig::EVENT_TOKEN => ComputopApiConfig::EVENT_TOKEN_GET,
        ];
    }
}
