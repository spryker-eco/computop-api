<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi;

interface ComputopApiConstants
{
    const MERCHANT_ID = 'COMPUTOP:MERCHANT_ID';
    const BLOWFISH_PASSWORD = 'COMPUTOP:BLOWFISH_PASSWORD';
    const HMAC_PASSWORD = 'COMPUTOP:HMAC_PASSWORD';

    const EASY_CREDIT_STATUS_ACTION = 'COMPUTOP:EASY_CREDIT_STATUS_ACTION';
    const EASY_CREDIT_AUTHORIZE_ACTION = 'COMPUTOP:EASY_CREDIT_AUTHORIZE_ACTION';

    const AUTHORIZE_ACTION = 'COMPUTOP:AUTHORIZE_ACTION';
    const CAPTURE_ACTION = 'COMPUTOP:CAPTURE_ACTION';
    const REVERSE_ACTION = 'COMPUTOP:REVERSE_ACTION';
    const INQUIRE_ACTION = 'COMPUTOP:INQUIRE_ACTION';
    const REFUND_ACTION = 'COMPUTOP:REFUND_ACTION';
    
    const RESPONSE_MAC_REQUIRED = 'COMPUTOP:RESPONSE_MAC_REQUIRED';
}
