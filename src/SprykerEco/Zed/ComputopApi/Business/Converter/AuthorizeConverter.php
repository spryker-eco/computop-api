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
     * @param array $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiAuthorizeResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiAuthorizeResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedResponse, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getAuthorizeMethodName())
        );
        // Optional field
        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
