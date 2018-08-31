<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper;

use SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory;
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
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReverseCreditCardMapper(): PostPlaceMapperInterface
    {
        return new ReverseCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquireCreditCardMapper(): PostPlaceMapperInterface
    {
        return new InquireCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureCreditCardMapper(): PostPlaceMapperInterface
    {
        return new CaptureCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundCreditCardMapper(): PostPlaceMapperInterface
    {
        return new RefundCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizePayNowMapper(): PostPlaceMapperInterface
    {
        return new AuthorizePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReversePayNowMapper(): PostPlaceMapperInterface
    {
        return new ReversePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePayNowMapper(): PostPlaceMapperInterface
    {
        return new InquirePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCapturePayNowMapper(): PostPlaceMapperInterface
    {
        return new CapturePayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundPayNowMapper(): PostPlaceMapperInterface
    {
        return new RefundPayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createAuthorizePayPalMapper(): PostPlaceMapperInterface
    {
        return new AuthorizePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReversePayPalMapper(): PostPlaceMapperInterface
    {
        return new ReversePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePayPalMapper(): PostPlaceMapperInterface
    {
        return new InquirePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCapturePayPalMapper(): PostPlaceMapperInterface
    {
        return new CapturePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundPayPalMapper(): PostPlaceMapperInterface
    {
        return new RefundPayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReverseDirectDebitMapper(): PostPlaceMapperInterface
    {
        return new ReverseDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquireDirectDebitMapper(): PostPlaceMapperInterface
    {
        return new InquireDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureDirectDebitMapper(): PostPlaceMapperInterface
    {
        return new CaptureDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundDirectDebitMapper(): PostPlaceMapperInterface
    {
        return new RefundDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundSofortMapper(): PostPlaceMapperInterface
    {
        return new RefundSofortMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReversePaydirektMapper(): PostPlaceMapperInterface
    {
        return new ReversePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePaydirektMapper(): PostPlaceMapperInterface
    {
        return new InquirePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCapturePaydirektMapper(): PostPlaceMapperInterface
    {
        return new CapturePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundPaydirektMapper(): PostPlaceMapperInterface
    {
        return new RefundPaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createAuthorizeEasyCreditMapper(): PostPlaceMapperInterface
    {
        return new AuthorizeEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureEasyCreditMapper(): PostPlaceMapperInterface
    {
        return new CaptureEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundEasyCreditMapper(): PostPlaceMapperInterface
    {
        return new RefundEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureIdealMapper(): PostPlaceMapperInterface
    {
        return new CaptureIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundIdealMapper(): PostPlaceMapperInterface
    {
        return new RefundIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;
     */
    public function createStatusEasyCreditMapper(): PrePlaceMapperInterface
    {
        return new StatusEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;
     */
    public function createCrifMapper(): ApiRiskCheckMapperInterface
    {
        return new CrifMapper(
            $this->getComputopApiService(),
            $this->getConfig()
        );
    }
}
