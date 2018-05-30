<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class AuthorizeConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopApiResponseTransfer = new ComputopApiAuthorizeResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedArray, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopService->extractHeader($decryptedArray, $this->config->getAuthorizeMethodName())
        );
        //optional field
        $computopApiResponseTransfer->setRefNr($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
