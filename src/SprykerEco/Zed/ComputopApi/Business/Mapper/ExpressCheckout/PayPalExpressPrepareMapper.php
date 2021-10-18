<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

class PayPalExpressPrepareMapper extends AbstractPayPalExpressMapper
{
    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $computopApiConfig;

    /**
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $computopApiConfig
     */
    public function __construct(
        ComputopApiConfig $computopApiConfig
    ) {
        $this->computopApiConfig = $computopApiConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string,string>
     */
    protected function encryptRequestData(QuoteTransfer $quoteTransfer): array
    {
        $computopPayPalExpressPaymentTransfer = $quoteTransfer->getPayment()->getComputopPayPalExpress();

        return [
            ComputopApiConstants::DATA => $computopPayPalExpressPaymentTransfer->getData(),
            ComputopApiConstants::LENGTH => $computopPayPalExpressPaymentTransfer->getLen(),
        ];
    }
}
