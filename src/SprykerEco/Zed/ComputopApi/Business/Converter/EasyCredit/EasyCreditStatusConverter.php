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
    const DECISION_INDEX = 'desicion';

    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopApiResponseTransfer = new ComputopApiEasyCreditStatusResponseTransfer();
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractHeader($decryptedArray, $this->config->getReverseMethodName())
        );
        $computopApiResponseTransfer->fromArray($decryptedArray, true);

        //easy credit index mistake will be fixed in future
        if (isset($decryptedArray[static::DECISION_INDEX])) {
            $computopApiResponseTransfer->setDecision($decryptedArray[static::DECISION_INDEX]);
        }

        return $computopApiResponseTransfer;
    }
}
