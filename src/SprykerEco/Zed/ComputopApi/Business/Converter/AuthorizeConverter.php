<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopAuthorizeResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class AuthorizeConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopAuthorizeResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopResponseTransfer = new ComputopAuthorizeResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedArray, true);
        $computopResponseTransfer->setHeader(
            $this->computopService->extractHeader($decryptedArray, $this->config->getAuthorizeMethodName())
        );
        //optional field
        $computopResponseTransfer->setRefNr($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::REF_NR));

        return $computopResponseTransfer;
    }
}
