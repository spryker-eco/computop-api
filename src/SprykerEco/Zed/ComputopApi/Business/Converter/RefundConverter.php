<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiRefundResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class RefundConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array<string, mixed> $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiRefundResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiRefundResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiRefundResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedResponse, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getRefundMethodName()),
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setAmount($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::AMOUNT));
        $computopApiResponseTransfer->setCodeExt($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
