<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ComputopApiServiceInterface
{
    /**
     * Specification:
     * - Generate description based on items
     *
     * @api
     *
     * @param array $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items);

    /**
     * Specification:
     * - Generate encrypted "Mac" value
     *
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $cardPaymentTransfer
     *
     * @return string
     */
    public function getMacEncryptedValue(TransferInterface $cardPaymentTransfer);

    /**
     * Specification:
     * - Generate header transfer by response array
     *
     * @api
     *
     * @param array $decryptedArray
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopResponseHeaderTransfer
     */
    public function extractHeader(array $decryptedArray, $method);

    /**
     * Specification:
     * - Gets value from response array by key (discarding formatting)
     *
     * @api
     *
     * @param array $responseArray
     * @param string $key
     *
     * @return null|string
     */
    public function getResponseValue(array $responseArray, $key);

    /**
     * Specification:
     * - Generate decrypted response array
     *
     * @api
     *
     * @param array $responseArray
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return array
     */
    public function getDecryptedArray(array $responseArray, $password);

    /**
     * Specification:
     * - Generate encrypted array for response
     *
     * @api
     *
     * @param array $dataSubArray
     * @param string $password
     *
     * @return array
     */
    public function getEncryptedArray(array $dataSubArray, $password);

    /**
     * Specification:
     * - Generate hash value
     *
     * @api
     *
     * @param string $value
     *
     * @return string
     */
    public function getHashValue($value);

    /**
     * Specification:
     * - Generate blowfish encrypted value
     *
     * @api
     *
     * @param string $plaintext
     * @param int $length
     * @param string $password
     *
     * @return string
     */
    public function getBlowfishEncryptedValue($plaintext, $length, $password);

    /**
     * Specification:
     * - Generate blowfish decrypted value
     *
     * @api
     *
     * @param string $cipher
     * @param int $length
     * @param string $password
     *
     * @return string
     */
    public function getBlowfishDecryptedValue($cipher, $length, $password);
}
