<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\AbstractConverter;

class PayPalExpressPrepareConverter extends AbstractConverter
{
    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(StreamInterface $response): TransferInterface
    {
        parse_str($response->getContents(), $responseHeader);

        return $this->getResponseTransfer($responseHeader);
    }

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
