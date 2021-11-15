<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiReverseResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class ReverseConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiReverseResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiReverseResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiReverseResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getReverseMethodName()),
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setCodeExt($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
