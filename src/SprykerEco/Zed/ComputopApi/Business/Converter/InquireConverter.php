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
    const EMPTY_AMOUNT = '0';

    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedArray)
    {
        $computopApiResponseTransfer = new ComputopApiInquireResponseTransfer();
        $computopApiResponseTransfer->fromArray($decryptedArray, true);
        $computopApiResponseTransfer->setHeader(
            $this->computopService->extractHeader($decryptedArray, $this->config->getInquireMethodName())
        );
        $computopApiResponseTransfer->setAmountAuth($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::AMOUNT_AUTH));
        $computopApiResponseTransfer->setAmountCap($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::AMOUNT_CAP));
        $computopApiResponseTransfer->setAmountCred($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::AMOUNT_CRED));
        $computopApiResponseTransfer->setLastStatus($this->computopService->getResponseValue($decryptedArray, ComputopApiConfig::LAST_STATUS));
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
    protected function isAuthLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer)
    {
        return $computopApiResponseTransfer->getAmountAuth() !== self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() === self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() === self::EMPTY_AMOUNT;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $computopApiResponseTransfer
     *
     * @return bool
     */
    protected function isCapLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer)
    {
        return $computopApiResponseTransfer->getAmountAuth() !== self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() !== self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() === self::EMPTY_AMOUNT;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $computopApiResponseTransfer
     *
     * @return bool
     */
    protected function isCredLast(ComputopApiInquireResponseTransfer $computopApiResponseTransfer)
    {
        return $computopApiResponseTransfer->getAmountAuth() !== self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCap() !== self::EMPTY_AMOUNT &&
            $computopApiResponseTransfer->getAmountCred() !== self::EMPTY_AMOUNT;
    }
}
