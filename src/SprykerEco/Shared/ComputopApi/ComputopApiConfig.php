<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class ComputopApiConfig extends AbstractBundleConfig
{
    public const PAYMENT_METHOD_PAY_NOW = 'computopPayNow';
    public const PAYMENT_METHOD_CREDIT_CARD = 'computopCreditCard';
    public const PAYMENT_METHOD_DIRECT_DEBIT = 'computopDirectDebit';
    public const PAYMENT_METHOD_IDEAL = 'computopIdeal';
    public const PAYMENT_METHOD_PAYDIREKT = 'computopPaydirekt';
    public const PAYMENT_METHOD_PAY_PAL = 'computopPayPal';
    public const PAYMENT_METHOD_SOFORT = 'computopSofort';
    public const PAYMENT_METHOD_EASY_CREDIT = 'computopEasyCredit';

    //Computop provider constants
    public const CAPTURE_MANUAL_TYPE = 'MANUAL';
    public const SUCCESS_STATUS = 'success';
    public const SUCCESS_OK_STATUS = 'OK';
}
