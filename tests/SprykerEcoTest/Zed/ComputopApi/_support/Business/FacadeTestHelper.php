<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCrifResponseTransfer;
use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\ComputopApiInquireResponseTransfer;
use Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer;
use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Generated\Shared\Transfer\ComputopApiRefundResponseTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\ComputopApiReverseResponseTransfer;
use Generated\Shared\Transfer\ComputopPayPalExpressPaymentTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiConfig as ComputopApiServiceConfig;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Service\ComputopApi\ComputopApiServiceFactory;
use SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressCompleteRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressPrepareRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\AuthorizationRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\CaptureRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\InquireRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\RefundRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\ReverseRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PrePlace\EasyCreditStatusRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck\CrifRequest;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeBridge;

class FacadeTestHelper extends Test
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory
     */
    public function createFactory()
    {
        $builder = $this->getMockBuilder(ComputopApiBusinessFactory::class);
        $builder->setMethods(
            [
                'getComputopApiService',
                'getStoreFacade',
                'getConfig',
                'createEasyCreditStatusRequest',
                'createEasyCreditAuthorizeRequest',
                'createAuthorizationPaymentRequest',
                'createInquirePaymentRequest',
                'createReversePaymentRequest',
                'createCapturePaymentRequest',
                'createRefundPaymentRequest',
                'createCrifRequest',
                'createPayPalExpressPrepareRequest',
                'createPayPalExpressCompleteRequest',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getComputopApiService')
            ->willReturn($this->createComputopApiService());
        $stub->method('getStoreFacade')
            ->willReturn($this->createStoreFacade());
        $stub->method('getConfig')
            ->willReturn($this->createConfig());
        $stub->method('createEasyCreditStatusRequest')
            ->willReturn($this->createEasyCreditStatusRequest());
        $stub->method('createEasyCreditAuthorizeRequest')
            ->willReturn($this->createEasyCreditAuthorizeRequest());
        $stub->method('createAuthorizationPaymentRequest')
            ->willReturn($this->createAuthorizationPaymentRequest());
        $stub->method('createInquirePaymentRequest')
            ->willReturn($this->createInquirePaymentRequest());
        $stub->method('createReversePaymentRequest')
            ->willReturn($this->createReversePaymentRequest());
        $stub->method('createCapturePaymentRequest')
            ->willReturn($this->createCapturePaymentRequest());
        $stub->method('createRefundPaymentRequest')
            ->willReturn($this->createRefundPaymentRequest());
        $stub->method('createCrifRequest')
            ->willReturn($this->createCrifRequest());
        $stub->method('createPayPalExpressPrepareRequest')
            ->willReturn($this->createPayPalExpressPrepareRequest());
        $stub->method('createPayPalExpressCompleteRequest')
            ->willReturn($this->createPayPalExpressCompleteRequest());

        return $stub;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected function createConfig()
    {
        return new ComputopApiConfig();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeBridge
     */
    protected function createStoreFacade()
    {
        return $this->createMock(ComputopApiToStoreFacadeBridge::class);
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\ComputopApiService
     */
    protected function createComputopApiService()
    {
        $service = new ComputopApiService();
        $service->setFactory($this->createServiceFactory());

        return $service;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Service\ComputopApi\ComputopApiServiceFactory
     */
    protected function createServiceFactory()
    {
        $builder = $this->getMockBuilder(ComputopApiServiceFactory::class);
        $builder->setMethods(
            [
                'getConfig',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->createServiceConfig());

        return $stub;
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected function createServiceConfig()
    {
        return new ComputopApiServiceConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuoteTrasfer()
    {
        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setTotals(
            (new TotalsTransfer())
                ->setHash(FacadeTestConstants::TOTAL_HASH_VALUE)
        );

        $quoteTransfer->setCustomer(
            (new CustomerTransfer())
                ->setCustomerReference(FacadeTestConstants::CUSTOMER_REFERENCE_VALUE)
        );

        $quoteTransfer->setOrderReference(FacadeTestConstants::ORDER_REFERENCE_VALUE);

        return $quoteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getPayPalExpressQuoteTrasfer()
    {
        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setTotals(
            (new TotalsTransfer())
                ->setHash(FacadeTestConstants::TOTAL_HASH_VALUE)
        );

        $quoteTransfer->setCustomer(
            (new CustomerTransfer())
                ->setCustomerReference(FacadeTestConstants::CUSTOMER_REFERENCE_VALUE)
        );

        $quoteTransfer->setOrderReference(FacadeTestConstants::ORDER_REFERENCE_VALUE);

        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setComputopPayPalExpress(new ComputopPayPalExpressPaymentTransfer());
        $quoteTransfer->setPayment($paymentTransfer);

        return $quoteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderTrasfer()
    {
        $orderTransfer = new OrderTransfer();
        $orderTransfer->setTotals(
            (new TotalsTransfer())
                ->setHash(FacadeTestConstants::TOTAL_HASH_VALUE)
        );

        $orderTransfer->setCustomer(
            (new CustomerTransfer())
                ->setCustomerReference(FacadeTestConstants::CUSTOMER_REFERENCE_VALUE)
        );

        $orderTransfer->setOrderReference(FacadeTestConstants::ORDER_REFERENCE_VALUE);

        return $orderTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer
     */
    public function createComputopApiHeaderPaymentTransfer()
    {
        return (new ComputopApiHeaderPaymentTransfer())
            ->setTransId(FacadeTestConstants::TRANS_ID_VALUE)
            ->setPayId(FacadeTestConstants::PAY_ID_VALUE)
            ->setAmount(FacadeTestConstants::AMOUNT_VALUE);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PrePlace\EasyCreditStatusRequest
     */
    protected function createEasyCreditStatusRequest()
    {
        $response = (new ComputopApiEasyCreditStatusResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(EasyCreditStatusRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\AuthorizationRequest
     */
    protected function createEasyCreditAuthorizeRequest()
    {
        $response = (new ComputopApiAuthorizeResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(AuthorizationRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\AuthorizationRequest
     */
    protected function createAuthorizationPaymentRequest()
    {
        $response = (new ComputopApiAuthorizeResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(AuthorizationRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\InquireRequest
     */
    protected function createInquirePaymentRequest()
    {
        $response = (new ComputopApiInquireResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(InquireRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\ReverseRequest
     */
    protected function createReversePaymentRequest()
    {
        $response = (new ComputopApiReverseResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(ReverseRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\CaptureRequest
     */
    protected function createCapturePaymentRequest()
    {
        $response = (new ComputopApiCaptureResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(CaptureRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\RefundRequest
     */
    protected function createRefundPaymentRequest()
    {
        $response = (new ComputopApiRefundResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer());

        $stub = $this->createMock(RefundRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck\CrifRequest
     */
    protected function createCrifRequest()
    {
        $response = (new ComputopApiCrifResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer())
            ->setCode(FacadeTestConstants::CODE_VALUE)
            ->setResult(FacadeTestConstants::CRIF_GREEN_RESULT)
            ->setStatus(FacadeTestConstants::STATUS_VALUE)
            ->setDescription(FacadeTestConstants::STATUS_VALUE_SUCCESS);

        $stub = $this->createMock(CrifRequest::class);
        $stub->method('request')
            ->willReturn($response);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressPrepareRequest
     */
    protected function createPayPalExpressPrepareRequest()
    {

        $response = (new ComputopApiPayPalExpressPrepareResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer())
            ->setToken(FacadeTestConstants::PAYPAL_EXPRESS_PREPARE_TOKEN)
            ->setOrderId(FacadeTestConstants::PAYPAL_EXPRESS_PREPARE_TOKEN);

        $quoteTransfer = $this->getPayPalExpressQuoteTrasfer();
        $quoteTransfer->getPayment()->getComputopPayPalExpress()->setPayPalExpressPrepareResponse($response);

        $stub = $this->createMock(PayPalExpressPrepareRequest::class);
        $stub->method('request')
            ->willReturn($quoteTransfer);

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressCompleteRequest
     */
    protected function createPayPalExpressCompleteRequest()
    {
        $response = (new ComputopApiPayPalExpressCompleteResponseTransfer())
            ->setHeader($this->createComputopApiResponseHeaderTransfer())
            ->setCode(FacadeTestConstants::CODE_VALUE)
            ->setStatus(FacadeTestConstants::STATUS_VALUE)
            ->setDescription(FacadeTestConstants::STATUS_VALUE_SUCCESS);

        $quoteTransfer = $this->getPayPalExpressQuoteTrasfer();
        $quoteTransfer->getPayment()->getComputopPayPalExpress()->setPayPalExpressCompleteResponse($response);

        $stub = $this->createMock(PayPalExpressCompleteRequest::class);
        $stub->method('request')
            ->willReturn($quoteTransfer);

        return $stub;
    }

    /**
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    protected function createComputopApiResponseHeaderTransfer()
    {
        return (new ComputopApiResponseHeaderTransfer())
            ->setTransId(FacadeTestConstants::TRANS_ID_VALUE)
            ->setPayId(FacadeTestConstants::PAY_ID_VALUE)
            ->setMId(FacadeTestConstants::M_ID_VALUE)
            ->setXId(FacadeTestConstants::X_ID_VALUE)
            ->setCode(FacadeTestConstants::CODE_VALUE)
            ->setDescription(FacadeTestConstants::DESCRIPTION_VALUE)
            ->setIsSuccess(true)
            ->setStatus(FacadeTestConstants::STATUS_VALUE);
    }
}
