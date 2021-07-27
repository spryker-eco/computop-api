<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class AuthorizeConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function getResponseTransfer(array $response): TransferInterface
    {
        $computopApiResponseTransfer = new ComputopApiAuthorizeResponseTransfer();
        $computopApiResponseTransfer->fromArray($response, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getAuthorizeMethodName())
        );

        $computopApiResponseTransfer->setRefNr($this->computopApiService->getResponseValue($response, ComputopApiConfig::REF_NR));

        return $computopApiResponseTransfer;
    }
}
