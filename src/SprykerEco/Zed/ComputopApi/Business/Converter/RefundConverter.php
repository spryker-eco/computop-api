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
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiRefundResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopApiResponseTransfer = new ComputopApiRefundResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedArray, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractHeader($decryptedArray, $this->config->getRefundMethodName())
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setAmount($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::AMOUNT));
        $computopApiResponseTransfer->setCodeExt($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($decryptedArray, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
