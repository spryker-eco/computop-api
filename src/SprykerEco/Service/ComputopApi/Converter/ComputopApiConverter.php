<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Converter;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiConfig;
use SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException;
use SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface;
use SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig as SharedComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;

class ComputopApiConverter implements ComputopApiConverterInterface
{
    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected $computopApiConfig;

    /**
     * @var \SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface
     */
    protected ComputopApiMapperInterface $computopApiMapper;

    /**
     * @var \SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface
     */
    protected HmacHasherInterface $hmacHasher;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfig $computopApiConfig
     * @param \SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface $computopApiMapper
     * @param \SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface $hmacHasher
     */
    public function __construct(ComputopApiConfig $computopApiConfig, ComputopApiMapperInterface $computopApiMapper, HmacHasherInterface $hmacHasher)
    {
        $this->computopApiConfig = $computopApiConfig;
        $this->computopApiMapper = $computopApiMapper;
        $this->hmacHasher = $hmacHasher;
    }

    /**
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, $method): ComputopApiResponseHeaderTransfer
    {
        $plaintextResponseHeader = $this->formatResponseArray($plaintextResponseHeader);
        $this->checkDecryptedResponse($plaintextResponseHeader);

        $header = new ComputopApiResponseHeaderTransfer();
        $header->fromArray($plaintextResponseHeader, true);
        $header->setMId($this->getResponseValue($plaintextResponseHeader, ComputopApiConstants::MERCHANT_ID_SHORT));
        $header->setTransId($this->getResponseValue($plaintextResponseHeader, ComputopApiConstants::TRANS_ID));
        $header->setPayId($this->getResponseValue($plaintextResponseHeader, ComputopApiConstants::PAY_ID));
        //optional
        $header->setMac($this->getResponseValue($plaintextResponseHeader, ComputopApiConstants::MAC));
        $header->setXId($this->getResponseValue($plaintextResponseHeader, ComputopApiConstants::X_ID));

        $header->setIsSuccess($this->isStatusSuccess($header));
        $header->setMethod($method);

        $macResponseEncryptedValue = $this->hmacHasher->getEncryptedValue(
            $this->computopApiMapper->getMacResponseEncryptedValue($header),
        );

        $this->checkMacResponse(
            (string)$header->getMac(),
            $macResponseEncryptedValue,
            (string)$header->getMethod(),
        );

        return $header;
    }

    /**
     * @param array $responseArray
     * @param string $key
     *
     * @return string|null
     */
    public function getResponseValue(array $responseArray, $key): ?string
    {
        $formattedKey = $this->formatKey($key);

        return $responseArray[$formattedKey] ?? null;
    }

    /**
     * @param string $decryptedString
     *
     * @return array<string, mixed>
     */
    public function getResponseDecryptedArray($decryptedString): array
    {
        $decryptedArray = [];
        $decryptedSubArray = explode($this->computopApiConfig->getDataSeparator(), $decryptedString) ?: [];

        foreach ($decryptedSubArray as $value) {
            $data = explode($this->computopApiConfig->getDataSubSeparator(), $value) ?: [];
            $decryptedArray[array_shift($data)] = array_shift($data);
        }

        return $this->formatResponseArray($decryptedArray);
    }

    /**
     * @param array $responseArray
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkEncryptedResponse(array $responseArray): void
    {
        $keys = [
            ComputopApiConstants::DATA,
            ComputopApiConstants::LENGTH,
        ];

        if (!$this->existArrayKeys($keys, $responseArray)) {
            throw new ComputopApiConverterException(
                'Response does not have expected values. Please check Computop documentation.',
            );
        }
    }

    /**
     * @param string $responseMac
     * @param string $expectedMac
     * @param string $method
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkMacResponse($responseMac, $expectedMac, $method): void
    {
        if ($this->computopApiConfig->isMacRequired($method) && $responseMac !== $expectedMac) {
            throw new ComputopApiConverterException('MAC is incorrect');
        }
    }

    /**
     * @param array $plaintextResponseHeader
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    protected function checkDecryptedResponse(array $plaintextResponseHeader): void
    {
        $keys = [
            ComputopApiConstants::MERCHANT_ID_SHORT,
            ComputopApiConstants::TRANS_ID,
            ComputopApiConstants::PAY_ID,
        ];

        if (!$this->existArrayKeys($keys, $plaintextResponseHeader)) {
            throw new ComputopApiConverterException(
                'Response does not have expected values. Please check Computop documentation.',
            );
        }
    }

    /**
     * @param array $keys
     * @param array $arraySearch
     *
     * @return bool
     */
    protected function existArrayKeys(array $keys, array $arraySearch): bool
    {
        $arraySearch = $this->formatResponseArray($arraySearch);

        foreach ($keys as $key) {
            if (!array_key_exists($this->formatKey($key), $arraySearch)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Computop returns keys in different formats. F.e. "BIC", "bic".
     * Function returns keys in one unique format.
     *
     * @param array $decryptedArray
     *
     * @return array<string, mixed>
     */
    protected function formatResponseArray(array $decryptedArray): array
    {
        $formattedArray = [];

        foreach ($decryptedArray as $key => $value) {
            $formattedArray[$this->formatKey($key)] = $value;
        }

        return $formattedArray;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected function formatKey($key): string
    {
        return mb_strtolower($key);
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header
     *
     * @return bool
     */
    protected function isStatusSuccess(ComputopApiResponseHeaderTransfer $header)
    {
        return $header->getStatus() === SharedComputopApiConfig::SUCCESS_STATUS ||
            $header->getStatus() === SharedComputopApiConfig::SUCCESS_OK_STATUS ||
            (int)$header->getCode() === 0;
    }
}
