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
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiCrifResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray): ComputopApiCrifResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiCrifResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedArray, true);
        $computopResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedArray, $this->config->getAuthorizeMethodName())
        );

        return $computopResponseTransfer;
    }
}
