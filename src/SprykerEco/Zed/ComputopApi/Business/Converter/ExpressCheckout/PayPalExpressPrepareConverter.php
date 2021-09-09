<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;

class PayPalExpressPrepareConverter implements ConverterInterface
{
    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(StreamInterface $response): TransferInterface
    {
        parse_str($response->getContents(), $responseHeader);

        return $this->createComputopApiPayPalExpressPrepareResponseTransfer($responseHeader);
    }

    /**
     * @param string[] $decryptedResponse
     *
     * @return \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer
     */
    protected function createComputopApiPayPalExpressPrepareResponseTransfer(array $decryptedResponse): ComputopApiPayPalExpressPrepareResponseTransfer
    {
        $computopResponseTransfer = new ComputopApiPayPalExpressPrepareResponseTransfer();
        $computopResponseTransfer->fromArray($decryptedResponse, true);

        return $computopResponseTransfer;
    }
}
