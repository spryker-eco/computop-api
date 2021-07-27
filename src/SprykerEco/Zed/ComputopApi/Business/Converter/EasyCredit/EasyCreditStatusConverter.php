<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\EasyCredit;

use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;

class EasyCreditStatusConverter extends AbstractConverter implements ConverterInterface
{
    protected const DECISION_INDEX = 'desicion';

    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function getResponseTransfer(array $response): TransferInterface
    {
        $computopApiResponseTransfer = new ComputopApiEasyCreditStatusResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getReverseMethodName())
        );
        $computopApiResponseTransfer->fromArray($response, true);

        // Easy credit index mistake will be fixed in future
        if (isset($response[static::DECISION_INDEX])) {
            $computopApiResponseTransfer->setDecision($response[static::DECISION_INDEX]);
        }

        return $computopApiResponseTransfer;
    }
}
