<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper\Init\PayNow;

use Generated\Shared\Transfer\ComputopPayNowInitResponseTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiConstants;
use SprykerEco\Zed\ComputopApi\Business\Mapper\Init\AbstractInitMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\Init\ApiInitMapperInterface;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

class InitPayNowMapper extends AbstractInitMapper implements ApiInitMapperInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $computopPaymentTransfer
     *
     * @return array
     */
    public function getDataSubArray(TransferInterface $computopPaymentTransfer)
    {
        /** @var \Generated\Shared\Transfer\ComputopPayNowPaymentTransfer $computopPaymentTransfer */
        $dataSubArray[ComputopApiConstants::CREDIT_CARD_NUMBER] = $computopPaymentTransfer->getCreditCardNumber();
        $dataSubArray[ComputopApiConstants::CREDIT_CARD_VERIFICATION_CODE] = $computopPaymentTransfer->getCreditCardVerificationCode();
        $dataSubArray[ComputopApiConstants::CREDIT_CARD_EXPIRY] = $computopPaymentTransfer->getCreditCardExpiresYear() . $computopPaymentTransfer->getCreditCardExpiresMonth();
        $dataSubArray[ComputopApiConstants::CREDIT_CARD_BRAND] = $computopPaymentTransfer->getCreditCardBrand();

        $dataSubArray[ComputopApiConstants::TRANS_ID] = $computopPaymentTransfer->getTransId();
        $dataSubArray[ComputopApiConstants::AMOUNT] = $computopPaymentTransfer->getAmount();
        $dataSubArray[ComputopApiConstants::CURRENCY] = $computopPaymentTransfer->getCurrency();
        $dataSubArray[ComputopApiConstants::URL_SUCCESS] = $computopPaymentTransfer->getUrlSuccess();
        $dataSubArray[ComputopApiConstants::URL_FAILURE] = $computopPaymentTransfer->getUrlFailure();
        $dataSubArray[ComputopApiConstants::URL_NOTIFY] = $computopPaymentTransfer->getUrlNotify();
        $dataSubArray[ComputopApiConstants::CAPTURE] = $computopPaymentTransfer->getCapture();
        $dataSubArray[ComputopApiConstants::RESPONSE] = $computopPaymentTransfer->getResponse();
        $dataSubArray[ComputopApiConstants::MAC] = $computopPaymentTransfer->getMac();
        $dataSubArray[ComputopApiConstants::TX_TYPE] = $computopPaymentTransfer->getTxType();
        $dataSubArray[ComputopApiConstants::ORDER_DESC] = $computopPaymentTransfer->getOrderDesc();
        $dataSubArray[ComputopApiConstants::ETI_ID] = ComputopApiConstants::ETI_ID;
        $dataSubArray[ComputopApiConstants::REF_NR] = $computopPaymentTransfer->getRefNr();
        $dataSubArray[ComputopApiConstants::REQ_ID] = $computopPaymentTransfer->getReqId();

        return $dataSubArray;
    }

    /**
     * @return \Generated\Shared\Transfer\ComputopPayNowInitResponseTransfer
     */
    protected function createPaymentTransfer()
    {
        return new ComputopPayNowInitResponseTransfer();
    }
}
