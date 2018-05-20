<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Model;

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
     * @param string $cipher
     * @param int $length
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\BlowfishException
     *
     * @return string
     */
    public function getBlowfishDecryptedValue($cipher, $length, $password);
}
