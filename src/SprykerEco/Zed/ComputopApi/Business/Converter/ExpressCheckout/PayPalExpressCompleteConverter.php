<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;

class PayPalExpressCompleteConverter extends AbstractConverter
{
    /**
     * @param array $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer
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
