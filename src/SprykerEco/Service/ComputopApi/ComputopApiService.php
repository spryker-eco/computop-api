<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Service\Kernel\AbstractService;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException;
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
     * @param ItemTransfer[] $items
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
     * @param ItemTransfer[] $items
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
    public function getMacEncryptedValue(ComputopApiRequestTransfer $requestTransfer): string
    {
        $value = $this->getFactory()->createComputopApiMapper()->getMacEncryptedValue($requestTransfer);

        return $this->getHashValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param array $decryptedArray
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractHeader(array $decryptedArray, $method): ComputopApiResponseHeaderTransfer
    {
        $header = $this->getFactory()->createComputopApiConverter()->extractHeader($decryptedArray, $method);

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
     * @param array $responseArray
     * @param string $password
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return array
     */
    public function getDecryptedArray(array $responseArray, $password): array
    {
        try {
            $this
                ->getFactory()
                ->createComputopApiConverter()
                ->checkEncryptedResponse($responseArray);
        } catch (ComputopApiConverterException $exception) {
            //TODO: remove this temporary unencrypted response when it is fixed on easyCredit api side

            return $responseArray;
        }

        $responseDecryptedString = $this->getBlowfishDecryptedValue(
            $responseArray[ComputopApiConfig::DATA],
            $responseArray[ComputopApiConfig::LENGTH],
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
     * @param string $plainText
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
     * @param \Generated\Shared\Transfer\OrderTransfer|\Generated\Shared\Transfer\QuoteTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     *
     * @return string
     */
    public function generateReqId(TransferInterface $transfer): string
    {
        return $this->getFactory()->createComputopApiMapper()->generateReqId($transfer);
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
