<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class ComputopApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const PAYMENT_METHOD_PAY_NOW = 'computopPayNow';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_CREDIT_CARD = 'computopCreditCard';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_DIRECT_DEBIT = 'computopDirectDebit';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_IDEAL = 'computopIdeal';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_PAYDIREKT = 'computopPaydirekt';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_PAY_PAL = 'computopPayPal';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_PAY_PAL_EXPRESS = 'computopPayPalExpress';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_SOFORT = 'computopSofort';
    /**
     * @var string
     */
    public const PAYMENT_METHOD_EASY_CREDIT = 'computopEasyCredit';

    //Computop provider constants
    /**
     * @var string
     */
    public const CAPTURE_TYPE_MANUAL = 'MANUAL';
    /**
     * @var string
     */
    public const CAPTURE_TYPE_AUTO = 'AUTO';
    /**
     * @var string
     */
    public const SUCCESS_STATUS = 'success';
    /**
     * @var string
     */
    public const SUCCESS_OK_STATUS = 'OK';
}
