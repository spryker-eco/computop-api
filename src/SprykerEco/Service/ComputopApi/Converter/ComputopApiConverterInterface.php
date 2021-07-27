<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Converter;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;

interface ComputopApiConverterInterface
{
    /**
     * @param array $plaintextResponseHeader
     * @param string $method
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function extractResponseHeader(array $plaintextResponseHeader, string $method): ComputopApiResponseHeaderTransfer;

    /**
     * @param array $responseArray
     * @param string $key
     *
     * @return string|null
     */
    public function getResponseValue(array $responseArray, string $key): ?string;

    /**
     * @param string $decryptedString
     *
     * @return array
     */
    public function getResponseDecryptedArray(string $decryptedString): array;

    /**
     * @param array $responseArray
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkEncryptedResponse(array $responseArray): void;

    /**
     * @param string|null $responseMac
     * @param string $expectedMac
     * @param string $method
     *
     * @throws \SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException
     *
     * @return void
     */
    public function checkMacResponse(?string $responseMac, string $expectedMac, string $method): void;
}
