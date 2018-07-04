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
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

/**
 * @method \SprykerEco\Service\ComputopApi\ComputopApiServiceFactory getFactory()
 */
class ComputopApiService extends AbstractService implements ComputopApiServiceInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items): string
    {
        return $this->getFactory()->createComputopApiMapper()->getDescriptionValue($items);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return string
     */
    public function getTestModeDescriptionValue(array $items): string
    {
        return $this->getFactory()->createComputopApiMapper()->getTestModeDescriptionValue($items);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
        $header = $this->getFactory()->createComputopApiConverter()->extractResponseHeader($plaintextResponseHeader, $method);

        $expectedMac = $this->getHashValue(
            $this->getFactory()->createComputopApiMapper()->getMacResponseEncryptedValue($header)
        );
        $this
            ->getFactory()
            ->createComputopApiConverter()
            ->checkMacResponse($header->getMac(), $expectedMac, $header->getMethod());

        return $header;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param string[] $responseArray
     * @param string $key
     *
     * @return null|string
     */
    public function getResponseValue(array $responseArray, $key): ?string
    {
        return $this->getFactory()->createComputopApiConverter()->getResponseValue($responseArray, $key);
    }

    /**
     * {@inheritdoc}
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
    public function decryptResponseHeader(array $responseHeader, $password): array
    {
        $this->getFactory()->createComputopApiConverter()->checkEncryptedResponse($responseHeader);

        $responseDecryptedString = $this->getBlowfishDecryptedValue(
            $responseHeader[ComputopApiConfig::DATA],
            $responseHeader[ComputopApiConfig::LENGTH],
            $password
        );

        $responseDecryptedArray = $this
            ->getFactory()
            ->createComputopApiConverter()
            ->getResponseDecryptedArray($responseDecryptedString);

        return $responseDecryptedArray;
    }

    /**
     * {@inheritdoc}
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
        $plainText = $this->getFactory()->createComputopApiMapper()->getDataPlainText($dataSubArray);
        $length = mb_strlen($plainText);

        $encryptedArray[ComputopApiConfig::DATA] = $this->getBlowfishEncryptedValue(
            $plainText,
            $length,
            $password
        );

        $encryptedArray[ComputopApiConfig::LENGTH] = $length;

        return $encryptedArray;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
}
