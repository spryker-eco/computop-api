<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopCaptureResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class CaptureConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopCaptureResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopResponseTransfer = new ComputopCaptureResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedArray, true);
        $computopResponseTransfer->setHeader(
            $this->computopService->extractHeader($decryptedArray, $this->config->getCaptureMethodName())
        );
        //optional fields
        $computopResponseTransfer->setAId($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::A_ID));
        $computopResponseTransfer->setTransactionId($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::TRANSACTION_ID));
        $computopResponseTransfer->setAmount($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::AMOUNT));
        $computopResponseTransfer->setCodeExt($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::CODE_EXT));
        $computopResponseTransfer->setErrorText($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::ERROR_TEXT));
        $computopResponseTransfer->setRefNr($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::REF_NR));

        return $computopResponseTransfer;
    }
}
