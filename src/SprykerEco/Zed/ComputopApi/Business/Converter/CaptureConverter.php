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
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer
     */
    protected function getResponseTransfer(array $response): ComputopApiCaptureResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiCaptureResponseTransfer();
        $computopApiResponseTransfer->fromArray($response, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getCaptureMethodName()),
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopApiService->getResponseValue($response, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopApiService->getResponseValue($response, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setAmount($this->computopApiService->getResponseValue($response, ComputopApiConfig::AMOUNT));
        $computopApiResponseTransfer->setCodeExt($this->computopApiService->getResponseValue($response, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopApiService->getResponseValue($response, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($response, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
