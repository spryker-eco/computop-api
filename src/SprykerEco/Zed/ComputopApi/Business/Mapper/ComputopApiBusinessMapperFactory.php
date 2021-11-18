<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper;

use SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressCompleteMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressPrepareMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\AuthorizeCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\CaptureCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\InquireCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\RefundCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\ReverseCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\CaptureDirectDebitMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\InquireDirectDebitMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\RefundDirectDebitMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\ReverseDirectDebitMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\AuthorizeEasyCreditMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\CaptureEasyCreditMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\RefundEasyCreditMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Ideal\CaptureIdealMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Ideal\RefundIdealMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\CapturePaydirektMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\InquirePaydirektMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\RefundPaydirektMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\ReversePaydirektMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\AuthorizePayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\CapturePayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\InquirePayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\RefundPayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\ReversePayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\AuthorizePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\CapturePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\InquirePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\RefundPayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\ReversePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\CapturePayPalExpressMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\RefundPayPalExpressMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\ReversePayPalExpressMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\CapturePayuCeeSingleMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\InquirePayuCeeSingleMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\RefundPayuCeeSingleMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\ReversePayuCeeSingleMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Sofort\RefundSofortMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\EasyCredit\StatusEasyCreditMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\CrifMapper;

/**
 * @method \SprykerEco\Zed\ComputopApi\ComputopApiConfig getConfig()
 */
class ComputopApiBusinessMapperFactory extends ComputopApiBusinessFactory implements ComputopApiBusinessMapperFactoryInterface
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeCreditCardMapper(): PostPlaceMapperInterface
    {
        return new AuthorizeCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\ReverseCreditCardMapper;
     */
    public function createReverseCreditCardMapper(): ReverseCreditCardMapper
    {
        return new ReverseCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\InquireCreditCardMapper;
     */
    public function createInquireCreditCardMapper(): InquireCreditCardMapper
    {
        return new InquireCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\CaptureCreditCardMapper;
     */
    public function createCaptureCreditCardMapper(): CaptureCreditCardMapper
    {
        return new CaptureCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\RefundCreditCardMapper ;
     */
    public function createRefundCreditCardMapper(): RefundCreditCardMapper
    {
        return new RefundCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\AuthorizePayNowMapper
     */
    public function createAuthorizePayNowMapper(): AuthorizePayNowMapper
    {
        return new AuthorizePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\ReversePayNowMapper ;
     */
    public function createReversePayNowMapper(): ReversePayNowMapper
    {
        return new ReversePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\InquirePayNowMapper ;
     */
    public function createInquirePayNowMapper(): InquirePayNowMapper
    {
        return new InquirePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\CapturePayNowMapper ;
     */
    public function createCapturePayNowMapper(): CapturePayNowMapper
    {
        return new CapturePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayNow\RefundPayNowMapper ;
     */
    public function createRefundPayNowMapper(): RefundPayNowMapper
    {
        return new RefundPayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\AuthorizePayPalMapper ;
     */
    public function createAuthorizePayPalMapper(): AuthorizePayPalMapper
    {
        return new AuthorizePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\ReversePayPalMapper ;
     */
    public function createReversePayPalMapper(): ReversePayPalMapper
    {
        return new ReversePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\ReversePayPalExpressMapper ;
     */
    public function createReversePayPalExpressMapper(): ReversePayPalExpressMapper
    {
        return new ReversePayPalExpressMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\InquirePayPalMapper ;
     */
    public function createInquirePayPalMapper(): InquirePayPalMapper
    {
        return new InquirePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\CapturePayPalMapper ;
     */
    public function createCapturePayPalMapper(): CapturePayPalMapper
    {
        return new CapturePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\CapturePayPalExpressMapper ;
     */
    public function createCapturePayPalExpressMapper(): CapturePayPalExpressMapper
    {
        return new CapturePayPalExpressMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\RefundPayPalMapper ;
     */
    public function createRefundPayPalMapper(): RefundPayPalMapper
    {
        return new RefundPayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPalExpress\RefundPayPalExpressMapper ;
     */
    public function createRefundPayPalExpressMapper(): RefundPayPalExpressMapper
    {
        return new RefundPayPalExpressMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\ReverseDirectDebitMapper ;
     */
    public function createReverseDirectDebitMapper(): ReverseDirectDebitMapper
    {
        return new ReverseDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\InquireDirectDebitMapper ;
     */
    public function createInquireDirectDebitMapper(): InquireDirectDebitMapper
    {
        return new InquireDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\CaptureDirectDebitMapper ;
     */
    public function createCaptureDirectDebitMapper(): CaptureDirectDebitMapper
    {
        return new CaptureDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\DirectDebit\RefundDirectDebitMapper ;
     */
    public function createRefundDirectDebitMapper(): RefundDirectDebitMapper
    {
        return new RefundDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Sofort\RefundSofortMapper ;
     */
    public function createRefundSofortMapper(): RefundSofortMapper
    {
        return new RefundSofortMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\ReversePaydirektMapper ;
     */
    public function createReversePaydirektMapper(): ReversePaydirektMapper
    {
        return new ReversePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\InquirePaydirektMapper ;
     */
    public function createInquirePaydirektMapper(): InquirePaydirektMapper
    {
        return new InquirePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\CapturePaydirektMapper ;
     */
    public function createCapturePaydirektMapper(): CapturePaydirektMapper
    {
        return new CapturePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Paydirekt\RefundPaydirektMapper ;
     */
    public function createRefundPaydirektMapper(): RefundPaydirektMapper
    {
        return new RefundPaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\AuthorizeEasyCreditMapper ;
     */
    public function createAuthorizeEasyCreditMapper(): AuthorizeEasyCreditMapper
    {
        return new AuthorizeEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\CaptureEasyCreditMapper ;
     */
    public function createCaptureEasyCreditMapper(): CaptureEasyCreditMapper
    {
        return new CaptureEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\EasyCredit\RefundEasyCreditMapper ;
     */
    public function createRefundEasyCreditMapper(): RefundEasyCreditMapper
    {
        return new RefundEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Ideal\CaptureIdealMapper ;
     */
    public function createCaptureIdealMapper(): CaptureIdealMapper
    {
        return new CaptureIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Ideal\RefundIdealMapper ;
     */
    public function createRefundIdealMapper(): RefundIdealMapper
    {
        return new RefundIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\EasyCredit\StatusEasyCreditMapper;
     */
    public function createStatusEasyCreditMapper(): StatusEasyCreditMapper
    {
        return new StatusEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\CrifMapper;
     */
    public function createCrifMapper(): CrifMapper
    {
        return new CrifMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\InquirePayuCeeSingleMapper ;
     */
    public function createInquirePayuCeeSingleMapper(): InquirePayuCeeSingleMapper
    {
        return new InquirePayuCeeSingleMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\ReversePayuCeeSingleMapper ;
     */
    public function createReversePayuCeeSingleMapper(): ReversePayuCeeSingleMapper
    {
        return new ReversePayuCeeSingleMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\CapturePayuCeeSingleMapper ;
     */
    public function createCapturePayuCeeSingleMapper(): CapturePayuCeeSingleMapper
    {
        return new CapturePayuCeeSingleMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayuCeeSingle\RefundPayuCeeSingleMapper ;
     */
    public function createRefundPayuCeeSingleMapper(): RefundPayuCeeSingleMapper
    {
        return new RefundPayuCeeSingleMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressPrepareMapper
     */
    public function createPayPalExpressPrepareMapper(): PayPalExpressPrepareMapper
    {
        return new PayPalExpressPrepareMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressCompleteMapper
     */
    public function createPayPalExpressCompleteMapper(): PayPalExpressCompleteMapper
    {
        return new PayPalExpressCompleteMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
        );
    }
}
