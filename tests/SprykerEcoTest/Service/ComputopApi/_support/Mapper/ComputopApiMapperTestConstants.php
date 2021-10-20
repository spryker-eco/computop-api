<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi\Mapper;

interface ComputopApiMapperTestConstants
{
    /**
     * @var string
     */
    public const PAY_ID_VALUE = 'PAY_ID_VALUE';

    /**
     * @var string
     */
    public const TRANS_ID_VALUE = 'TRANS_ID_VALUE';

    /**
     * @var string
     */
    public const MERCHANT_ID_VALUE = 'MERCHANT_ID_VALUE';

    /**
     * @var int
     */
    public const AMOUNT_VALUE = 1;

    /**
     * @var string
     */
    public const CURRENCY_VALUE = 'USD';

    /**
     * @var string
     */
    public const STATUS_VALUE = 'OK';

    /**
     * @var string
     */
    public const CODE_VALUE = '000000';

    /**
     * @var string
     */
    public const EXPECTED_MAC = 'PAY_ID_VALUE*TRANS_ID_VALUE*MERCHANT_ID_VALUE*1*USD';

    /**
     * @var string
     */
    public const EXPECTED_MAC_RESPONSE = 'PAY_ID_VALUE*TRANS_ID_VALUE*MERCHANT_ID_VALUE*OK*000000';

    /**
     * @var string
     */
    public const EXPECTED_PLAINTEXT = 'test_key=test_value';
}
