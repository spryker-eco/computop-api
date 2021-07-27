<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Hasher;

interface HmacHasherInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function getEncryptedValue(string $value): string;
}
