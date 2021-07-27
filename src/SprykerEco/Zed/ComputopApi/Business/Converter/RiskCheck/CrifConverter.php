<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\RiskCheck;

use Generated\Shared\Transfer\ComputopApiCrifResponseTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;

class CrifConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiCrifResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function getResponseTransfer(array $response): TransferInterface
    {
        $computopResponseTransfer = new ComputopApiCrifResponseTransfer();
        $computopResponseTransfer->fromArray($response, true);
        $computopResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getAuthorizeMethodName())
        );

        return $computopResponseTransfer;
    }
}
