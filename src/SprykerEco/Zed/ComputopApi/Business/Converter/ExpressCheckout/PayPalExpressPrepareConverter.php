<?php

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;

class PayPalExpressPrepareConverter extends AbstractConverter
{
    /**
     * @param array $decryptedResponse
     *
     * @return ComputopApiPayPalExpressPrepareResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiPayPalExpressPrepareResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiPayPalExpressPrepareResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedResponse, true);

        return $computopResponseTransfer;
    }
}
