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
    public const MERCHANT_ID = 'COMPUTOPAPI:MERCHANT_ID';
    public const BLOWFISH_PASSWORD = 'COMPUTOPAPI:BLOWFISH_PASSWORD';
    public const HMAC_PASSWORD = 'COMPUTOPAPI:HMAC_PASSWORD';

    public const EASY_CREDIT_STATUS_ACTION = 'COMPUTOPAPI:EASY_CREDIT_STATUS_ACTION';
    public const EASY_CREDIT_AUTHORIZE_ACTION = 'COMPUTOPAPI:EASY_CREDIT_AUTHORIZE_ACTION';

    public const CRIF_ACTION = 'COMPUTOPAPI:CRIF_ACTION';
    public const CRIF_PRODUCT_NAME = 'COMPUTOPAPI:CRIF_PRODUCT_NAME';
    public const CRIF_LEGAL_FORM = 'COMPUTOPAPI:CRIF_LEGAL_FORM';

    public const AUTHORIZE_ACTION = 'COMPUTOPAPI:AUTHORIZE_ACTION';
    public const CAPTURE_ACTION = 'COMPUTOPAPI:CAPTURE_ACTION';
    public const REVERSE_ACTION = 'COMPUTOPAPI:REVERSE_ACTION';
    public const INQUIRE_ACTION = 'COMPUTOPAPI:INQUIRE_ACTION';
    public const REFUND_ACTION = 'COMPUTOPAPI:REFUND_ACTION';

    public const RESPONSE_MAC_REQUIRED = 'COMPUTOPAPI:RESPONSE_MAC_REQUIRED';

    public const PAYMENT_METHODS_CAPTURE_TYPES = 'COMPUTOPAPI:PAYMENT_METHODS_CAPTURE_TYPES';
}
