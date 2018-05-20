<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class AuthorizeEasyCreditMapper extends AbstractEasyCreditMapper
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    public function getDataSubArray(TransferInterface $computopPaymentTransfer)
    {
        /** @var \Generated\Shared\Transfer\ComputopEasyCreditPaymentTransfer $computopPaymentTransfer */
        $dataSubArray = parent::getDataSubArray($computopPaymentTransfer);
        $dataSubArray[ComputopApiConfig::EVENT_TOKEN] = ComputopApiConfig::EVENT_TOKEN_AUTHORIZE;

        return $dataSubArray;
    }
}
