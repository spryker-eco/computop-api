<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as SharedComputopApiConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

class PayPalExpressCompleteMapper extends AbstractPayPalExpressMapper
{
    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected $computopApiService;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $computopApiConfig
     */
    public function __construct(
        ComputopApiServiceInterface $computopApiService,
        ComputopApiConfig $computopApiConfig
    ) {
        parent::__construct($computopApiConfig);
        $this->computopApiService = $computopApiService;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, string>
     */
    protected function encryptRequestData(QuoteTransfer $quoteTransfer): array
    {
        $encryptedValues = $this->computopApiService->getEncryptedArray(
            $this->getDataSubArray($quoteTransfer),
            $this->computopApiConfig->getBlowfishPass(),
        );

        return [
            ComputopApiConstants::DATA => $encryptedValues[ComputopApiConstants::DATA],
            ComputopApiConstants::LENGTH => $encryptedValues[ComputopApiConstants::LENGTH],
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, string>
     */
    protected function getDataSubArray(QuoteTransfer $quoteTransfer): array
    {
        $computopPayPalExpressPaymentTransfer = $quoteTransfer->getPaymentOrFail()->getComputopPayPalExpress();

        return [
            SharedComputopApiConfig::TRANS_ID => $computopPayPalExpressPaymentTransfer->getTransId(),
            SharedComputopApiConfig::MERCHANT_ID => $this->computopApiConfig->getMerchantId(),
            SharedComputopApiConfig::PAY_ID => $computopPayPalExpressPaymentTransfer->getPayPalExpressPrepareResponse()->getPayID(),
            SharedComputopApiConfig::REF_NR => $computopPayPalExpressPaymentTransfer->getRefNr(),
            SharedComputopApiConfig::AMOUNT => $quoteTransfer->getTotals()->getGrandTotal(),
            SharedComputopApiConfig::CURRENCY => $computopPayPalExpressPaymentTransfer->getCurrency(),
        ];
    }
}
