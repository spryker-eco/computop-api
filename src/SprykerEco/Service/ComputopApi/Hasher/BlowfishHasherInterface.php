<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Hasher;

interface BlowfishHasherInterface
{
    /**
     * @param string $plaintext
     * @param int $length
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\BlowfishException
     *
     * @return string
     */
    public function getBlowfishEncryptedValue($plaintext, $length, $password);

    /**
     * @param string $cipherText
     * @param int $length
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\BlowfishException
     *
     * @return string
     */
    public function getBlowfishDecryptedValue($cipherText, $length, $password);
}
