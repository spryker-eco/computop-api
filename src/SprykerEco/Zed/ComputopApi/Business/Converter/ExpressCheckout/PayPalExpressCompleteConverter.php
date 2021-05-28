<?php

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;

class PayPalExpressCompleteConverter extends AbstractConverter
{
    /**
     * @param array $decryptedResponse
     *
     * @return ComputopApiPayPalExpressCompleteResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiPayPalExpressCompleteResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiPayPalExpressCompleteResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedResponse, true);
        $computopApiResponseHeaderTransfer = $this
            ->computopApiService
            ->extractResponseHeader($decryptedResponse, '');

        $computopResponseTransfer->setHeader($computopApiResponseHeaderTransfer);

        return $computopResponseTransfer;
    }
}
