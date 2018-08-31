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
        $dataSubArray[ComputopApiConfig::PAY_ID] = $computopApiRequestTransfer->getPayId();
        $dataSubArray[ComputopApiConfig::TRANS_ID] = $computopApiRequestTransfer->getTransId();
        $dataSubArray[ComputopApiConfig::REQ_ID] = $computopApiRequestTransfer->getReqId();
        $dataSubArray[ComputopApiConfig::REF_NR] = $computopApiRequestTransfer->getRefNr();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $computopApiRequestTransfer->getAmount();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $computopApiRequestTransfer->getCurrency();
        $dataSubArray[ComputopApiConfig::MAC] = $computopApiRequestTransfer->getMac();
        $dataSubArray[ComputopApiConfig::EVENT_TOKEN] = ComputopApiConfig::EVENT_TOKEN_GET;

        return $dataSubArray;
    }
}
