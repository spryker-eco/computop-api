<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteTransfer;
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
        $computopApiPayPalExpressCompleteTransfer = $this->createTransferWithUnencryptedValues($quoteTransfer);

        $encryptedValues = $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($computopApiPayPalExpressCompleteTransfer),
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
     * @return \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteTransfer
     */
    protected function createTransferWithUnencryptedValues(QuoteTransfer $quoteTransfer): ComputopApiPayPalExpressCompleteTransfer
    {
        $paymentTransfer = $quoteTransfer->getPayment()->getComputopPayPalExpress();

        $computopPayPalExpressCompleteTransfer = new ComputopApiPayPalExpressCompleteTransfer();
        $computopPayPalExpressCompleteTransfer->setMerchantId($this->computopApiConfig->getMerchantId());
        $computopPayPalExpressCompleteTransfer->setPayId($paymentTransfer->getPayId());
        $computopPayPalExpressCompleteTransfer->setTransactionId($paymentTransfer->getTransId());
        $computopPayPalExpressCompleteTransfer->setRefNr($paymentTransfer->getRefNr());
        $computopPayPalExpressCompleteTransfer->setAmount($quoteTransfer->getTotals()->getGrandTotal());
        $computopPayPalExpressCompleteTransfer->setCurrency($paymentTransfer->getCurrency());

        return $computopPayPalExpressCompleteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteTransfer $computopApiPayPalExpressCompleteTransfer
     *
     * @return string[]
     */
    protected function getDataSubArray(ComputopApiPayPalExpressCompleteTransfer $computopApiPayPalExpressCompleteTransfer): array
    {
        $dataSubArray[ComputopApiConfig::TRANS_ID] = $computopApiPayPalExpressCompleteTransfer->getTransactionId();
        $dataSubArray[ComputopApiConfig::MERCHANT_ID] = $computopApiPayPalExpressCompleteTransfer->getMerchantId();
        $dataSubArray[ComputopApiConfig::PAY_ID] = $computopApiPayPalExpressCompleteTransfer->getPayId();
        $dataSubArray[ComputopApiConfig::REF_NR] = $computopApiPayPalExpressCompleteTransfer->getRefNr();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $computopApiPayPalExpressCompleteTransfer->getAmount();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $computopApiPayPalExpressCompleteTransfer->getCurrency();

        return $dataSubArray;
    }
}
