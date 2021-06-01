<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\ComputopApi\Config;

interface ComputopApiConfig
{
    public const MERCHANT_ID = 'MerchantID';
    public const MERCHANT_ID_SHORT = 'mid';
    public const TRANS_ID = 'TransID';
    public const AMOUNT = 'Amount';
    public const AMOUNT_AUTH = 'AmountAuth';
    public const AMOUNT_CAP = 'AmountCap';
    public const AMOUNT_CRED = 'AmountCred';
    public const LAST_STATUS = 'LastStatus';
    public const CURRENCY = 'Currency';
    public const URL_SUCCESS = 'URLSuccess';
    public const URL_FAILURE = 'URLFailure';
    public const URL_BACK = 'URLBack';
    public const TEMPLATE = 'template';
    public const URL_NOTIFY = 'URLNotify';
    public const CAPTURE = 'Capture';
    public const RESPONSE = 'Response';
    public const MAC = 'MAC';
    public const TX_TYPE = 'TxType';
    public const ORDER_DESC = 'OrderDesc';
    public const PAY_ID = 'PayID';
    public const STATUS = 'Status';
    public const DESCRIPTION = 'Description';
    public const CODE = 'Code';
    public const X_ID = 'XID';
    public const CUSTOMER_TRANSACTION_ID = 'TID';
    public const TYPE = 'Type';
    public const PC_NR = 'PCNr';
    public const CREDIT_CARD_NUMBER = 'CCNr';
    public const CREDIT_CARD_VERIFICATION_CODE = 'CCCVC';
    public const CREDIT_CARD_EXPIRY = 'CCExpiry';
    public const CREDIT_CARD_BRAND = 'CCBrand';
    public const MASKED_PAN = 'MaskedPan';
    public const CAVV = 'CAVV';
    public const ECI = 'ECI';
    public const PLAIN = 'Plain';
    public const REF_NR = 'RefNr';
    public const INFO_TEXT = 'InfoText';
    public const A_ID = 'AID';
    public const CODE_EXT = 'CodeExt';
    public const ERROR_TEXT = 'ErrorText';
    public const TRANSACTION_ID = 'TransactionID';
    public const FINISH_AUTH = 'FinishAuth';
    public const ETI_ID = 'EtiId';
    public const REQ_ID = 'ReqID';
    public const DATA = 'Data';
    public const LENGTH = 'Len';
    public const NO_SHIPPING = 'NoShipping';
    public const EMAIL = 'e-mail';
    public const FIRST_NAME = 'firstname';
    public const LAST_NAME = 'lastname';
    public const CUSTOM = 'Custom';
    public const PHONE = 'Phone';
    public const BILLING_AGREEMENT_ID = 'BillingAgreementID';
    public const BILLING_NAME = 'BillingName';
    public const BILLING_ADDRESS_STREET = 'BillingAddrStreet';
    public const BILLING_ADDRESS_STREET2 = 'BillingAddrStreet2';
    public const BILLING_ADDRESS_CITY = 'BillingAddrCity';
    public const BILLING_ADDRESS_STATE = 'BillingAddrState';
    public const BILLING_ADDRESS_ZIP = 'BillingAddrZIP';
    public const BILLING_ADDRESS_COUNTRY_CODE = 'BillingAddrCountryCode';
    public const ADDRESS_STREET = 'AddrStreet';
    public const ADDRESS_STREET_NR = 'AddrStreetNr';
    public const ADDRESS_STREET2 = 'AddrStreet2';
    public const ADDRESS_ADDITIONAL = 'AddrAddition';
    public const ADDRESS_CITY = 'AddrCity';
    public const ADDR_ZIP = 'AddrZip';
    public const ADDR_EMAIL = 'Email';
    public const ADDRESS_STATE = 'AddrState';
    public const ADDRESS_ZIP = 'AddrZIP';
    public const ADDRESS_COUNTRY_CODE = 'AddrCountryCode';
    public const BIRTHDAY = 'Birthday';
    public const AGE = 'Age';
    public const PAYER_ID = 'PayerID';
    public const IS_FINANCING = 'IsFinancing';
    public const FINANCING_FEE_AMOUNT = 'FinancingFeeAmount';
    public const FINANCING_MONTHLY_PAYMENT = 'FinancingMonthlyPayment';
    public const FINANCING_TERM = 'FinancingTerm';
    public const FINANCING_TOTAL_COST = 'FinancingTotalCost';
    public const GROSS_AMOUNT = 'GrossAmount';
    public const FEE_AMOUNT = 'FeeAmount';
    public const SETTLE_AMOUNT = 'SettleAmount';
    public const TAX_AMOUNT = 'TaxAmount';
    public const EXCHANGE_RATE = 'ExchangeRate';
    public const MC_FEE = 'mc_fee';
    public const MC_GROSS = 'mc_gross';
    public const MANDATE_ID = 'mandateid';
    public const DATE_OF_SIGNATURE_ID = 'dtofsgntr';
    public const BANK_ACCOUNT_IBAN = 'IBAN';
    public const BANK_ACCOUNT_PBAN = 'pban';
    public const BANK_ACCOUNT_BIC = 'bic';
    public const ACCOUNT_OWNER = 'AccOwner';
    public const ACCOUNT_BANK = 'AccBank';
    public const MDT_SEQ_TYPE = 'mdtseqtype';
    public const SHOP_API_KEY = 'shopApiKey';
    public const SHOPPING_BASKET_AMOUNT = 'ShoppingBasketAmount';
    public const SHOPPING_BASKET_CATEGORY = 'ShoppingBasketCategory';
    public const SHIPPING_AMOUNT = 'shAmount';
    public const SHIPPING_FIRST_NAME = 'sdFirstName';
    public const SHIPPING_LAST_NAME = 'sdLastName';
    public const SHIPPING_ZIP = 'sdZip';
    public const SHIPPING_CITY = 'sdCity';
    public const SHIPPING_COUNTRY_CODE = 'sdCountryCode';
    public const SHIPPING_COMPANY = 'sdCompany';
    public const SHIPPING_ADDRESS_ADDITION = 'sdAddressAddition';
    public const SHIPPING_STREET = 'sdStreet';
    public const SHIPPING_STREET_NUMBER = 'sdStreetNr';
    public const SHIPPING_EMAIL = 'sdEMail';
    public const AGE_ACCEPTED = 'AgeAccepted';
    public const PAYMENT_PURPOSE = 'paymentPurpose';
    public const PAYMENT_GUARANTEE = 'paymentGuarantee';
    public const EVENT_TOKEN = 'EventToken';
    public const EVENT_TOKEN_INIT = 'INT';
    public const EVENT_TOKEN_GET = 'GET';
    public const EVENT_TOKEN_AUTHORIZE = 'CON';
    public const CAPTURE_MANUAL = 'MANUAL';
    public const DATE = 'Date';
    public const REASON = 'Reason';
    public const REASON_FULL_CANCELL = 'WIDERRUF_VOLLSTAENDIG';
    public const REASON_PART_CANCELL = 'WIDERRUF_TEILWEISE';
    public const REASON_FULL_CANCELL_GUARANTEE = 'RUECKGABE_GARANTIE_GEWAEHRLEISTUNG';
    public const REASON_PART_CANCELL_GUARANTEE = 'MINDERUNG_GARANTIE_GEWAEHRLEISTUNG';
    public const PAYDIRECT_TRANS_ID_LENGTH = 20;
    public const REQ_ID_LENGTH = 32;
    public const PRODUCT_NAME = 'ProductName';
    public const CUSTOMER_ID = 'CustomerID';
    public const LEGAL_FORM = 'LegalForm';
    public const ORDER_ID = 'OrderId';
}
