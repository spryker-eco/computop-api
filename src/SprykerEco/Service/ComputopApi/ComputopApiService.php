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
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \SprykerEco\Service\ComputopApi\ComputopApiServiceFactory getFactory()
 */
class ComputopApiService extends AbstractService implements ComputopApiServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items): string
    {
        return $this->getFactory()->createComputopApiMapper()->getDescriptionValue($items);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return string
     */
    public function generateEncryptedMac(ComputopApiRequestTransfer $requestTransfer): string
    {
        $value = $this->getFactory()->createComputopApiMapper()->getPlaintextMac($requestTransfer);

        return $this->getHashValue($value);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, $method): ComputopApiResponseHeaderTransfer
    {
        return $this->getFactory()->createComputopApiConverter()->extractResponseHeader($plaintextResponseHeader, $method);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string> $responseArray
     * @param string $key
     *
     * @return string|null
     */
    public function getResponseValue(array $responseArray, $key): ?string
    {
        return $this->getFactory()->createComputopApiConverter()->getResponseValue($responseArray, $key);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $responseHeader
     * @param string $password
     *
     * @return array<string, mixed>
     */
    public function decryptResponseHeader(array $responseHeader, $password): array
    {
        return $this->getFactory()->createComputopApiConverter()->getResponseDecryptedArray($responseHeader, $password);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $dataSubArray
     * @param string $password
     *
     * @return array
     */
    public function getEncryptedArray(array $dataSubArray, $password): array
    {
        return $this->getFactory()->createComputopApiMapper()->getEncryptedArray($dataSubArray, $password);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $value
     *
     * @return string
     */
    public function getHashValue($value): string
    {
        return $this->getFactory()->createHmacHasher()->getEncryptedValue($value);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $plaintext
     * @param int $length
     * @param string $password
     *
     * @return string
     */
    public function getBlowfishEncryptedValue($plaintext, $length, $password): string
    {
        return $this->getFactory()->createBlowfishHasher()->getBlowfishEncryptedValue($plaintext, $length, $password);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $cipherText
     * @param int $length
     * @param string $password
     *
     * @return string
     */
    public function getBlowfishDecryptedValue($cipherText, $length, $password): string
    {
        return $this->getFactory()->createBlowfishHasher()->getBlowfishDecryptedValue($cipherText, $length, $password);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateReqIdFromQuoteTransfer(QuoteTransfer $quoteTransfer): string
    {
        return $this->getFactory()->createComputopApiMapper()->generateReqIdFromQuoteTransfer($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function generateReqIdFromOrderTransfer(OrderTransfer $orderTransfer): string
    {
        return $this->getFactory()->createComputopApiMapper()->generateReqIdFromOrderTransfer($orderTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateTransId(QuoteTransfer $quoteTransfer): string
    {
        return $this->getFactory()->createComputopApiMapper()->generateTransId($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param int $limit
     *
     * @return string
     */
    public function generateLimitedTransId(QuoteTransfer $quoteTransfer, int $limit): string
    {
        return $this->getFactory()->createComputopApiMapper()->generateLimitedTransId($quoteTransfer, $limit);
    }
}
