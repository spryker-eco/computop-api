<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;

class PayPalExpressPrepareConverter extends AbstractConverter
{
    /**
     * @param array $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer
     */
    protected function getResponseTransfer(array $decryptedResponse): ComputopApiPayPalExpressPrepareResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiPayPalExpressPrepareResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedResponse, true);

        return $computopResponseTransfer;
    }
}
