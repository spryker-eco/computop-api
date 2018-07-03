<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi;

interface ComputopApiConstants
{
    public const MERCHANT_ID = 'COMPUTOPAPI:MERCHANT_ID';
    public const BLOWFISH_PASSWORD = 'COMPUTOPAPI:BLOWFISH_PASSWORD';
    public const HMAC_PASSWORD = 'COMPUTOPAPI:HMAC_PASSWORD';

    public const EASY_CREDIT_STATUS_ACTION = 'COMPUTOPAPI:EASY_CREDIT_STATUS_ACTION';
    public const EASY_CREDIT_AUTHORIZE_ACTION = 'COMPUTOPAPI:EASY_CREDIT_AUTHORIZE_ACTION';

    public const AUTHORIZE_ACTION = 'COMPUTOPAPI:AUTHORIZE_ACTION';
    public const CAPTURE_ACTION = 'COMPUTOPAPI:CAPTURE_ACTION';
    public const REVERSE_ACTION = 'COMPUTOPAPI:REVERSE_ACTION';
    public const INQUIRE_ACTION = 'COMPUTOPAPI:INQUIRE_ACTION';
    public const REFUND_ACTION = 'COMPUTOPAPI:REFUND_ACTION';
    
    public const RESPONSE_MAC_REQUIRED = 'COMPUTOPAPI:RESPONSE_MAC_REQUIRED';
}
