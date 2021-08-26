<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Hasher;

use SprykerEco\Service\ComputopApi\ComputopApiConfig;

class HmacHasher implements HmacHasherInterface
{
    protected const HASH_TYPE = 'sha256';

    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfig $config
     */
    public function __construct(ComputopApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function getEncryptedValue($value): string
    {
        return strtoupper(
            hash_hmac(static::HASH_TYPE, $value, $this->config->getHmacPassword())
        );
    }
}
