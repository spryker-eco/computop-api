<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Model\Converter;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException;
use SprykerEco\Service\ComputopApi\Model\AbstractComputopApi;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;

class ComputopApiConverter extends AbstractComputopApi implements ComputopApiConverterInterface
{
    /**
     * @param array $decryptedArray
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractHeader(array $decryptedArray, $method)
    {
        $decryptedArray = $this->formatResponseArray($decryptedArray);
        $this->checkDecryptedResponse($decryptedArray);

        $header = new ComputopApiResponseHeaderTransfer();
        $header->fromArray($decryptedArray, true);
        $header->setMId($this->getResponseValue($decryptedArray, ComputopApiConstants::MERCHANT_ID_SHORT));
        $header->setTransId($this->getResponseValue($decryptedArray, ComputopApiConstants::TRANS_ID));
        $header->setPayId($this->getResponseValue($decryptedArray, ComputopApiConstants::PAY_ID));
        //optional
        $header->setMac($this->getResponseValue($decryptedArray, ComputopApiConstants::MAC));
        $header->setXId($this->getResponseValue($decryptedArray, ComputopApiConstants::X_ID));

        $header->setIsSuccess(
            $header->getStatus() === ComputopApiConfig::SUCCESS_STATUS ||
            $header->getStatus() === ComputopApiConfig::SUCCESS_OK_STATUS
        );
        $header->setMethod($method);

        return $header;
    }

    /**
     * @param array $responseArray
     * @param string $key
     *
     * @return null|string
     */
    public function getResponseValue(array $responseArray, $key)
    {
        if (isset($responseArray[$this->formatKey($key)])) {
            return $responseArray[$this->formatKey($key)];
        }

        return null;
    }

    /**
     * @param string $decryptedString
     *
     * @return array
     */
    public function getResponseDecryptedArray($decryptedString)
    {
        $decryptedArray = [];
        $decryptedSubArray = explode(self::DATA_SEPARATOR, $decryptedString);
        foreach ($decryptedSubArray as $value) {
            $data = explode(self::DATA_SUB_SEPARATOR, $value);
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
    public function checkEncryptedResponse(array $responseArray)
    {
        $keys = [
            ComputopApiConstants::DATA,
            ComputopApiConstants::LENGTH,
        ];

        if (!$this->existArrayKeys($keys, $responseArray)) {
            throw new ComputopApiConverterException(
                'Response does not have expected values. Please check Computop documentation.'
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
    public function checkMacResponse($responseMac, $expectedMac, $method)
    {
        if ($this->config->isMacRequired($method) && $responseMac !== $expectedMac) {
            throw new ComputopApiConverterException('MAC is incorrect');
        }
    }

    /**
     * @param array $decryptedArray
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    protected function checkDecryptedResponse(array $decryptedArray)
    {
        $keys = [
            ComputopApiConstants::MERCHANT_ID_SHORT,
            ComputopApiConstants::TRANS_ID,
            ComputopApiConstants::PAY_ID,
        ];

        if (!$this->existArrayKeys($keys, $decryptedArray)) {
            throw new ComputopApiConverterException(
                'Response does not have expected values. Please check Computop documentation.'
            );
        }
    }

    /**
     * @param array $keys
     * @param array $arraySearch
     *
     * @return bool
     */
    protected function existArrayKeys(array $keys, array $arraySearch)
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
     * @return array
     */
    protected function formatResponseArray(array $decryptedArray)
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
    protected function formatKey($key)
    {
        return mb_strtolower($key);
    }
}
