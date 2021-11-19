<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class CaptureConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array<string, mixed> $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiCaptureResponseTransfer
    {
        return (new ComputopApiCaptureResponseTransfer())
            ->fromArray($decryptedResponse, true)
            ->setHeader($this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getCaptureMethodName()))
            ->setAId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::A_ID))
            ->setTransactionId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::TRANSACTION_ID))
            ->setAmount($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::AMOUNT))
            ->setCodeExt($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::CODE_EXT))
            ->setErrorText($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::ERROR_TEXT))
            ->setRefNr($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::REF_NR));
    }
}
