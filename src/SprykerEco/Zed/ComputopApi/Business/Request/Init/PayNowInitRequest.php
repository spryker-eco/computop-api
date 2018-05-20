<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\Init;

use SprykerEco\Shared\ComputopApi\ComputopApiConfig;

class PayNowInitRequest extends AbstractInitPaymentRequest implements InitRequestInterface
{
    /**
     * @return string
     */
    public function getMethodName()
    {
        return ComputopApiConfig::PAYMENT_METHOD_PAY_NOW;
    }
}
