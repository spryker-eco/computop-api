<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\RiskCheck;

use Generated\Shared\Transfer\ComputopApiCrifResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;

class CrifConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array<string, mixed> $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiCrifResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiCrifResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiCrifResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedResponse, true);
        $computopResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getAuthorizeMethodName()),
        );

        return $computopResponseTransfer;
    }
}
