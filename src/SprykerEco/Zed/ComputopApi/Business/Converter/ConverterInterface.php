<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use GuzzleHttp\Psr7\Stream;

interface ConverterInterface
{
    /**
     * @param \GuzzleHttp\Psr7\Stream $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(Stream $response);
}
