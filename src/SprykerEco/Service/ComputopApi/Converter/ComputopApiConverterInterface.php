<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Converter;

interface ComputopApiConverterInterface
{
    /**
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, $method);

    /**
     * @param array $responseArray
     * @param string $key
     *
     * @return null|string
     */
    public function getResponseValue(array $responseArray, $key);

    /**
     * @param string $decryptedString
     *
     * @return array
     */
    public function getResponseDecryptedArray($decryptedString);

    /**
     * @param array $responseArray
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkEncryptedResponse(array $responseArray);

    /**
     * @param string $responseMac
     * @param string $expectedMac
     * @param string $method
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkMacResponse($responseMac, $expectedMac, $method);
}
