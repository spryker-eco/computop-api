<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\EasyCredit;

use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;

class EasyCreditStatusConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @var string
     */
    protected const DECISION_INDEX = 'desicion';

    /**
     * @param array<string, mixed> $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiEasyCreditStatusResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiEasyCreditStatusResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getReverseMethodName()),
        );
        $computopApiResponseTransfer->fromArray($decryptedResponse, true);

        //easy credit index mistake will be fixed in future
        if (isset($decryptedResponse[static::DECISION_INDEX])) {
            $computopApiResponseTransfer->setDecision($decryptedResponse[static::DECISION_INDEX]);
        }

        return $computopApiResponseTransfer;
    }
}
