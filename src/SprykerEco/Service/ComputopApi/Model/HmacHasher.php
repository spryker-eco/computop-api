<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Model;

use SprykerEco\Service\ComputopApi\ComputopApiConfigInterface;

class HmacHasher implements HmacHasherInterface
{
    protected const HASH_TYPE = 'sha256';

    /**
     * @var \Spryker\Service\Kernel\AbstractBundleConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfigInterface $config
     */
    public function __construct(ComputopApiConfigInterface $config)
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
