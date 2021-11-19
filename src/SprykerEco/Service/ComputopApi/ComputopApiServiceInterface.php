<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
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
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $items
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
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return string
     */
    public function generateEncryptedMac(ComputopApiRequestTransfer $requestTransfer);

    /**
     * Specification:
     * - Generate header transfer by response array
     * - Requires `ComputopApiResponseHeaderTransfer.mac` and `ComputopApiResponseHeaderTransfer.method` to bet set.
     *
     * @api
     *
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, $method);

    /**
     * Specification:
     * - Gets value from response array by key (discarding formatting)
     *
     * @api
     *
     * @param array<string> $responseArray
     * @param string $key
     *
     * @return string|null
     */
    public function getResponseValue(array $responseArray, $key);

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
     * @return array<string, mixed>
     */
    public function decryptResponseHeader(array $responseHeader, $password);

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
     * - Generate ReqId from QuoteTransfer for Computop calls
     * - Requires `QuoteTransfer.TotalsTransfer.hash` and `QuoteTransfer.CustomerTransfer`
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateReqIdFromQuoteTransfer(QuoteTransfer $quoteTransfer);

    /**
     * Specification:
     * - Generate ReqId from OrderTransfer for Computop calls
     * - Requires `QuoteTransfer.TotalsTransfer.hash` and `QuoteTransfer.CustomerTransfer`
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function generateReqIdFromOrderTransfer(OrderTransfer $orderTransfer);

    /**
     * Specification:
     * - Generate TransId for Computop calls
     * - Requires `QuoteTransfer.CustomerTransfer`
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateTransId(QuoteTransfer $quoteTransfer);

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
    public function generateLimitedTransId(QuoteTransfer $quoteTransfer, int $limit);
}
