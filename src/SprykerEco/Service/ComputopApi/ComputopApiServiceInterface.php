<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface ComputopApiServiceInterface
{
    /**
     * Specification:
     * - Generate description based on items
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items): string;

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
    public function generateEncryptedMac(ComputopApiRequestTransfer $requestTransfer): string;

    /**
     * Specification:
     * - Generate header transfer by response array
     *
     * @api
     *
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, string $method): ComputopApiResponseHeaderTransfer;

    /**
     * Specification:
     * - Gets value from response array by key (discarding formatting)
     *
     * @api
     *
     * @param string[] $responseArray
     * @param string $key
     *
     * @return string|null
     */
    public function getResponseValue(array $responseArray, string $key): ?string;

    /**
     * Specification:
     * - Decrypt response header
     *
     * @api
     *
     * @param array $responseHeader
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return array
     */
    public function decryptResponseHeader(array $responseHeader, string $password): array;

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
    public function getEncryptedArray(array $dataSubArray, string $password): array;

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
    public function getHashValue(string $value): string;

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
    public function getBlowfishEncryptedValue(string $plaintext, int $length, string $password): string;

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
    public function getBlowfishDecryptedValue(string $cipherText, int $length, string $password): string;

    /**
     * Specification:
     * - Generate ReqId from QuoteTransfer for Computop calls
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateReqIdFromQuoteTransfer(QuoteTransfer $quoteTransfer): string;

    /**
     * Specification:
     * - Generate ReqId from OrderTransfer for Computop calls
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function generateReqIdFromOrderTransfer(OrderTransfer $orderTransfer): string;

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
    public function generateTransId(QuoteTransfer $quoteTransfer): string;

    /**
     * Specification:
     * - Generate TransId for Computop calls with limited length
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param int $limit
     *
     * @return string
     */
    public function generateLimitedTransId(QuoteTransfer $quoteTransfer, int $limit): string;
}
