<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiInquireResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class InquireConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @var string
     */
    protected const EMPTY_AMOUNT = '0';

    /**
     * @param array<string, mixed> $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiInquireResponseTransfer
    {
        $computopApiResponseTransfer = new ComputopApiInquireResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedResponse, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($decryptedResponse, $this->config->getInquireMethodName()),
        );
        $computopApiResponseTransfer->setAmountAuth($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::AMOUNT_AUTH));
        $computopApiResponseTransfer->setAmountCap($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::AMOUNT_CAP));
        $computopApiResponseTransfer->setAmountCred($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::AMOUNT_CRED));
        $computopApiResponseTransfer->setLastStatus($this->computopApiService->getResponseValue($decryptedResponse, ComputopApiConfig::LAST_STATUS));
        //set custom options
        $computopApiResponseTransfer->setIsAuthLast($this->isAuthLast($computopApiResponseTransfer));
        $computopApiResponseTransfer->setIsCapLast($this->isCapLast($computopApiResponseTransfer));
        $computopApiResponseTransfer->setIsCredLast($this->isCredLast($computopApiResponseTransfer));

        return $computopApiResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $computopApiResponseTransfer
     *
     * @return bool
     */
    protected function isAuthLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer): bool
    {
        return $computopApiResponseTransfer->getAmountAuth() !== static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() === static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() === static::EMPTY_AMOUNT;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $computopApiResponseTransfer
     *
     * @return bool
     */
    protected function isCapLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer): bool
    {
        return $computopApiResponseTransfer->getAmountAuth() !== static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() !== static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() === static::EMPTY_AMOUNT;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $computopApiResponseTransfer
     *
     * @return bool
     */
    protected function isCredLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer): bool
    {
        return $computopApiResponseTransfer->getAmountAuth() !== static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() !== static::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() !== static::EMPTY_AMOUNT;
    }
}
