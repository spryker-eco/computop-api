<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface ComputopApiConstants
{
    /**
     * @var string
     */
    public const MERCHANT_ID = 'COMPUTOPAPI:MERCHANT_ID';
    /**
     * @var string
     */
    public const BLOWFISH_PASSWORD = 'COMPUTOPAPI:BLOWFISH_PASSWORD';
    /**
     * @var string
     */
    public const HMAC_PASSWORD = 'COMPUTOPAPI:HMAC_PASSWORD';

    /**
     * @var string
     */
    public const EASY_CREDIT_STATUS_ACTION = 'COMPUTOPAPI:EASY_CREDIT_STATUS_ACTION';
    /**
     * @var string
     */
    public const EASY_CREDIT_AUTHORIZE_ACTION = 'COMPUTOPAPI:EASY_CREDIT_AUTHORIZE_ACTION';

    /**
     * @var string
     */
    public const CRIF_ACTION = 'COMPUTOPAPI:CRIF_ACTION';
    /**
     * @var string
     */
    public const CRIF_PRODUCT_NAME = 'COMPUTOPAPI:CRIF_PRODUCT_NAME';
    /**
     * @var string
     */
    public const CRIF_LEGAL_FORM = 'COMPUTOPAPI:CRIF_LEGAL_FORM';

    /**
     * @var string
     */
    public const AUTHORIZE_ACTION = 'COMPUTOPAPI:AUTHORIZE_ACTION';
    /**
     * @var string
     */
    public const CAPTURE_ACTION = 'COMPUTOPAPI:CAPTURE_ACTION';
    /**
     * @var string
     */
    public const REVERSE_ACTION = 'COMPUTOPAPI:REVERSE_ACTION';
    /**
     * @var string
     */
    public const INQUIRE_ACTION = 'COMPUTOPAPI:INQUIRE_ACTION';
    /**
     * @var string
     */
    public const REFUND_ACTION = 'COMPUTOPAPI:REFUND_ACTION';

    /**
     * @var string
     */
    public const PAYPAL_EXPRESS_PREPARE_ACTION = 'COMPUTOPAPI:PAYPAL_EXPRESS_PREPARE_ACTION';
    /**
     * @var string
     */
    public const PAYPAL_EXPRESS_COMPLETE_ACTION = 'COMPUTOPAPI:PAYPAL_EXPRESS_COMPLETE_ACTION';

    /**
     * @var string
     */
    public const RESPONSE_MAC_REQUIRED = 'COMPUTOPAPI:RESPONSE_MAC_REQUIRED';

    /**
     * @var string
     */
    public const PAYMENT_METHODS_CAPTURE_TYPES = 'COMPUTOPAPI:PAYMENT_METHODS_CAPTURE_TYPES';
}
