<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class AuthorizeEasyCreditMapper extends AbstractEasyCreditMapper
{
    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $computopApiRequestTransfer
     *
     * @return array
     */
    public function getDataSubArray(ComputopApiRequestTransfer $computopApiRequestTransfer): array
    {
        $dataSubArray = parent::getDataSubArray($computopApiRequestTransfer);
        $dataSubArray[ComputopApiConfig::EVENT_TOKEN] = ComputopApiConfig::EVENT_TOKEN_AUTHORIZE;

        return $dataSubArray;
    }
}
