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
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiReverseResponseTransfer
     */
    protected function getResponseTransfer(array $response): ComputopApiReverseResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiReverseResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getReverseMethodName()),
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopApiService->getResponseValue($response, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopApiService->getResponseValue($response, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setCodeExt($this->computopApiService->getResponseValue($response, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopApiService->getResponseValue($response, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($response, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
