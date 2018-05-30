<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use SprykerEco\Shared\Computop\Config\ComputopApiConfig;

class RefundEasyCreditMapper extends AbstractEasyCreditMapper
{
    const DATE_TIME_FORMAT = 'YYYY-mm-dd';

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer)
    {
        $dataSubArray = parent::getDataSubArray($computopApiRequestTransfer);
        $dataSubArray[ComputopApiConfig::DATE] = $computopApiRequestTransfer->getDate();

        $dataSubArray[ComputopApiConfig::REASON] = ComputopApiConfig::REASON_FULL_CANCELL;

        return $dataSubArray;
    }
}
