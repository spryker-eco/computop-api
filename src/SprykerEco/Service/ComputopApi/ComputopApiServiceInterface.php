<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ComputopApiServiceInterface
{
    /**
     * Specification:
     * - Generate description based on items
     *
     * @api
     *
     * @param ItemTransfer[] $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items);

    /**
     * Specification:
     * - Generate description based on items and enabled test mode
     *
     * @api
     *
     * @param ItemTransfer[] $items
     *
     * @return string
     */
    public function getTestModeDescriptionValue(array $items);

    /**
     * Specification:
     * - Generate encrypted "Mac" value
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return string
     */
    public function getMacEncryptedValue(ComputopApiRequestTransfer $requestTransfer);

    /**
     * Specification:
     * - Generate header transfer by response array
     *
     * @api
     *
     * @param array $decryptedArray
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractHeader(array $decryptedArray, $method);

    /**
     * Specification:
     * - Gets value from response array by key (discarding formatting)
     *
     * @api
     *
     * @param string[] $responseArray
     * @param string $key
     *
     * @return null|string
     */
    public function getResponseValue(array $responseArray, $key);

    /**
     * Specification:
     * - Decrypt response header
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
     * - Encrypt response header
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
     * - Encyrpt value using blowfish algorithm
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
     * - Decrypt value using blowfish algorithm
     *
     * @api
     *
     * @param string $cipherText
     * @param int $length
     * @param string $password
     *
     * @return string
     */
    public function getBlowfishDecryptedValue($cipherText, $length, $password);

    /**
     * Specification:
     * - Generate ReqId for Computop calls
     * - OrderTransfer or QuoteTransfer uses
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer|\Generated\Shared\Transfer\QuoteTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     *
     * @return string
     */
    public function generateReqId(TransferInterface $transfer);

    /**
     * Specification:
     * - Generate TransId for Computop calls
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateTransId(QuoteTransfer $quoteTransfer);
}
