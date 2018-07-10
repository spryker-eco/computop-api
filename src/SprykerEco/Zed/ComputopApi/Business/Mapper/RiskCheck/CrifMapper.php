<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;

class CrifMapper extends AbstractRiskCheckMapper implements ApiRiskCheckMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function getDataSubArray(QuoteTransfer $quoteTransfer, ComputopApiRequestTransfer $requestTransfer): array
    {
        $dataSubArray[ComputopApiConfig::MERCHANT_ID] = $requestTransfer->getMerchantId();
        $dataSubArray[ComputopApiConfig::TRANS_ID] = $requestTransfer->getTransId();
        $dataSubArray[ComputopApiConfig::ORDER_DESC] = $requestTransfer->getOrderDesc();
        $dataSubArray[ComputopApiConfig::AMOUNT] = $requestTransfer->getAmount();
        $dataSubArray[ComputopApiConfig::CURRENCY] = $requestTransfer->getCurrency();
        $dataSubArray[ComputopApiConfig::MAC] = $this->computopApiService->generateEncryptedMac($requestTransfer);
        $dataSubArray[ComputopApiConfig::PRODUCT_NAME] = $this->config->getCrifProductName();
        $dataSubArray[ComputopApiConfig::CUSTOMER_ID] = $quoteTransfer->getCustomer()->getCustomerReference();
        $dataSubArray[ComputopApiConfig::LEGAL_FORM] = $this->config->getCrifLegalForm();
        $dataSubArray[ComputopApiConfig::FIRST_NAME] = $quoteTransfer->getShippingAddress()->getFirstName();
        $dataSubArray[ComputopApiConfig::LAST_NAME] = $quoteTransfer->getShippingAddress()->getLastName();
        $dataSubArray[ComputopApiConfig::ADDRESS_STREET] = $quoteTransfer->getShippingAddress()->getAddress1();
        $dataSubArray[ComputopApiConfig::ADDRESS_STREET_NR] = $quoteTransfer->getShippingAddress()->getAddress2();
        $dataSubArray[ComputopApiConfig::ADDRESS_ADDITIONAL] = $quoteTransfer->getShippingAddress()->getAddress3();
        $dataSubArray[ComputopApiConfig::ADDRESS_CITY] = $quoteTransfer->getShippingAddress()->getCity();
        $dataSubArray[ComputopApiConfig::ADDR_ZIP] = $quoteTransfer->getShippingAddress()->getZipCode();
        $dataSubArray[ComputopApiConfig::ADDR_EMAIL] = $quoteTransfer->getCustomer()->getEmail();
        $dataSubArray[ComputopApiConfig::PHONE] = $quoteTransfer->getShippingAddress()->getPhone();

        return $dataSubArray;
    }
}
