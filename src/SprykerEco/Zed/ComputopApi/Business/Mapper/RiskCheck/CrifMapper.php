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
        return [
            ComputopApiConfig::MERCHANT_ID => $requestTransfer->getMerchantId(),
            ComputopApiConfig::TRANS_ID => $requestTransfer->getTransId(),
            ComputopApiConfig::ORDER_DESC => $requestTransfer->getOrderDesc(),
            ComputopApiConfig::AMOUNT => $requestTransfer->getAmount(),
            ComputopApiConfig::CURRENCY => $requestTransfer->getCurrency(),
            ComputopApiConfig::MAC => $this->computopApiService->generateEncryptedMac($requestTransfer),
            ComputopApiConfig::PRODUCT_NAME => $this->config->getCrifProductName(),
            ComputopApiConfig::CUSTOMER_ID => $quoteTransfer->getCustomer()->getCustomerReference(),
            ComputopApiConfig::LEGAL_FORM => $this->config->getCrifLegalForm(),
            ComputopApiConfig::FIRST_NAME => $quoteTransfer->getShippingAddress()->getFirstName(),
            ComputopApiConfig::LAST_NAME => $quoteTransfer->getShippingAddress()->getLastName(),
            ComputopApiConfig::ADDRESS_STREET => $quoteTransfer->getShippingAddress()->getAddress1(),
            ComputopApiConfig::ADDRESS_STREET_NR => $quoteTransfer->getShippingAddress()->getAddress2(),
            ComputopApiConfig::ADDRESS_ADDITIONAL => $quoteTransfer->getShippingAddress()->getAddress3(),
            ComputopApiConfig::ADDRESS_CITY => $quoteTransfer->getShippingAddress()->getCity(),
            ComputopApiConfig::ADDR_ZIP => $quoteTransfer->getShippingAddress()->getZipCode(),
            ComputopApiConfig::ADDR_EMAIL => $quoteTransfer->getCustomer()->getEmail(),
            ComputopApiConfig::PHONE => $quoteTransfer->getShippingAddress()->getPhone(),
        ];
    }
}
