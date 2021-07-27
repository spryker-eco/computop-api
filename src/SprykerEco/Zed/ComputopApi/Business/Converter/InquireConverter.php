<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiInquireResponseTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class InquireConverter extends AbstractConverter implements ConverterInterface
{
    protected const EMPTY_AMOUNT = '0';

    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function getResponseTransfer(array $response): TransferInterface
    {
        $computopApiResponseTransfer = new ComputopApiInquireResponseTransfer();
        $computopApiResponseTransfer->fromArray($response, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopApiService->extractResponseHeader($response, $this->config->getInquireMethodName())
        );
        $computopApiResponseTransfer->setAmountAuth($this->computopApiService->getResponseValue($response, ComputopApiConfig::AMOUNT_AUTH));
        $computopApiResponseTransfer->setAmountCap($this->computopApiService->getResponseValue($response, ComputopApiConfig::AMOUNT_CAP));
        $computopApiResponseTransfer->setAmountCred($this->computopApiService->getResponseValue($response, ComputopApiConfig::AMOUNT_CRED));
        $computopApiResponseTransfer->setLastStatus($this->computopApiService->getResponseValue($response, ComputopApiConfig::LAST_STATUS));

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
