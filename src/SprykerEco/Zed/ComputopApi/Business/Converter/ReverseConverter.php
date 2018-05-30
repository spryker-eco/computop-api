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
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiReverseResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopApiResponseTransfer = new ComputopApiReverseResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopService->extractHeader($decryptedArray, $this->config->getReverseMethodName())
        );
        //optional fields
        $computopApiResponseTransfer->setAId($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::A_ID));
        $computopApiResponseTransfer->setTransactionId($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::TRANSACTION_ID));
        $computopApiResponseTransfer->setCodeExt($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CODE_EXT));
        $computopApiResponseTransfer->setErrorText($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::ERROR_TEXT));
        $computopApiResponseTransfer->setRefNr($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
