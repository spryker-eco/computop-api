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
     * @var string
     */
    protected const MAC_SEPARATOR = '*';

    /**
     * @phpstan-var non-empty-string
     *
     * @var string
     */
    protected const DATA_SEPARATOR = '&';

    /**
     * @phpstan-var non-empty-string
     *
     * @var string
     */
    protected const DATA_SUB_SEPARATOR = '=';

    /**
     * @api
     *
     * @param string $method
     *
     * @return bool
     */
    public function isMacRequired($method): bool
    {
        return $method && in_array($method, (array)$this->get(ComputopApiConstants::RESPONSE_MAC_REQUIRED, []), true);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getHmacPassword(): string
    {
        return $this->get(ComputopApiConstants::HMAC_PASSWORD);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMacSeparator(): string
    {
        return static::MAC_SEPARATOR;
    }

    /**
     * @api
     *
     * @phpstan-return non-empty-string
     *
     * @return string
     */
    public function getDataSeparator(): string
    {
        return static::DATA_SEPARATOR;
    }

    /**
     * @api
     *
     * @phpstan-return non-empty-string
     *
     * @return string
     */
    public function getDataSubSeparator(): string
    {
        return static::DATA_SUB_SEPARATOR;
    }
}
