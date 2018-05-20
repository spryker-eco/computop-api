<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper;

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
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\AuthorizePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\CapturePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\InquirePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\RefundPayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PayPal\ReversePayPalMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\Sofort\RefundSofortMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\EasyCredit\StatusEasyCreditMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PayNow\InitPayNowMapper;
use SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory;

/**
 * @method \SprykerEco\Zed\ComputopApi\ComputopApiConfig getConfig()
 * @method \SprykerEco\Zed\ComputopApi\Persistence\ComputopApiQueryContainerInterface getQueryContainer()
 */
class ComputopApiBusinessMapperFactory extends ComputopApiBusinessFactory implements ComputopApiBusinessMapperFactoryInterface
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeCreditCardMapper()
    {
        return new AuthorizeCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReverseCreditCardMapper()
    {
        return new ReverseCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquireCreditCardMapper()
    {
        return new InquireCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureCreditCardMapper()
    {
        return new CaptureCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundCreditCardMapper()
    {
        return new RefundCreditCardMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createAuthorizePayPalMapper()
    {
        return new AuthorizePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReversePayPalMapper()
    {
        return new ReversePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePayPalMapper()
    {
        return new InquirePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCapturePayPalMapper()
    {
        return new CapturePayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundPayPalMapper()
    {
        return new RefundPayPalMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReverseDirectDebitMapper()
    {
        return new ReverseDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquireDirectDebitMapper()
    {
        return new InquireDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureDirectDebitMapper()
    {
        return new CaptureDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundDirectDebitMapper()
    {
        return new RefundDirectDebitMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundSofortMapper()
    {
        return new RefundSofortMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createReversePaydirektMapper()
    {
        return new ReversePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePaydirektMapper()
    {
        return new InquirePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCapturePaydirektMapper()
    {
        return new CapturePaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundPaydirektMapper()
    {
        return new RefundPaydirektMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createAuthorizeEasyCreditMapper()
    {
        return new AuthorizeEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureEasyCreditMapper()
    {
        return new CaptureEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundEasyCreditMapper()
    {
        return new RefundEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createCaptureIdealMapper()
    {
        return new CaptureIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createRefundIdealMapper()
    {
        return new RefundIdealMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;
     */
    public function createStatusEasyCreditMapper()
    {
        return new StatusEasyCreditMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PayNow\InitPayNowMapper
     */
    public function createInitPayNowMapper()
    {
        return new InitPayNowMapper(
            $this->getComputopApiService(),
            $this->getConfig(),
            $this->getStore(),
            $this->getQueryContainer()
        );
    }
}
