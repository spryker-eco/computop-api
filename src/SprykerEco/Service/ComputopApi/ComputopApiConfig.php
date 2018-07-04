<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\ComputopApi\ComputopApiConstants;

class ComputopApiConfig extends AbstractBundleConfig
{
    /**
     * Test mode enabled
     * It changes description for API calls
     */
    protected const COMPUTOP_TEST_MODE_ENABLED = true;

    protected const MAC_SEPARATOR = '*';
    protected const DATA_SEPARATOR = '&';
    protected const DATA_SUB_SEPARATOR = '=';

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMacRequired($method): bool
    {
        return in_array($method, (array)$this->get(ComputopApiConstants::RESPONSE_MAC_REQUIRED, []));
    }

    /**
     * @return string
     */
    public function getHmacPassword(): string
    {
        return $this->get(ComputopApiConstants::HMAC_PASSWORD);
    }

    /**
     * @return bool
     */
    public function isTestMode(): bool
    {
        return static::COMPUTOP_TEST_MODE_ENABLED;
    }

    /**
     * @return string
     */
    public function getMacSeparator(): string
    {
        return static::MAC_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getDataSeparator(): string
    {
        return static::DATA_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getDataSubSeparator(): string
    {
        return static::DATA_SUB_SEPARATOR;
    }
}
