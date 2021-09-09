<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;

class PayPalExpressCompleteMapper extends AbstractPayPalExpressMapper
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string[]
     */
    protected function encryptRequestData(QuoteTransfer $quoteTransfer): array
    {
        $encryptedValues = $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($quoteTransfer),
            $this->computopApiConfig->getBlowfishPass()
        );

        return [
            ComputopApiConstants::DATA => $encryptedValues[ComputopApiConstants::DATA],
            ComputopApiConstants::LENGTH => $encryptedValues[ComputopApiConstants::LENGTH],
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string[]
     */
    protected function getDataSubArray(QuoteTransfer $quoteTransfer): array
    {
        $computopPayPalExpressPaymentTransfer = $quoteTransfer->getPayment()->getComputopPayPalExpress();

        $dataSubArray[ComputopApiConfig::TRANS_ID] = $computopPayPalExpressPaymentTransfer->getTransId();
        $dataSubArray[ComputopApiConfig::MERCHANT_ID] = $this->computopApiConfig->getMerchantId();
        $dataSubArray[ComputopApiConfig::PAY_ID] = $computopPayPalExpressPaymentTransfer->getPayPalExpressPrepareResponse()->getPayID();
        $dataSubArray[ComputopApiConfig::REF_NR] = $computopPayPalExpressPaymentTransfer->getRefNr();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $quoteTransfer->getTotals()->getGrandTotal();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $computopPayPalExpressPaymentTransfer->getCurrency();

        return $dataSubArray;
    }
}
