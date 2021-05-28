<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AuthorizeAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\CaptureAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\EasyCredit\EasyCreditAuthorizeAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\EasyCredit\EasyCreditStatusAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\ExpressCheckout\PayPalExpressCompleteAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\ExpressCheckout\PayPalExpressPrepareAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\InquireAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\RefundAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\ReverseAdapter;
use SprykerEco\Zed\ComputopApi\Business\Adapter\RiskCheck\CrifApiAdapter;
use SprykerEco\Zed\ComputopApi\Business\Converter\AuthorizeConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\CaptureConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\EasyCredit\EasyCreditStatusConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressCompleteConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressPrepareConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\InquireConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\RefundConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\ReverseConverter;
use SprykerEco\Zed\ComputopApi\Business\Converter\RiskCheck\CrifConverter;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ComputopApiBusinessMapperFactory;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ComputopApiBusinessMapperFactoryInterface;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressCompleteRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressCompleteRequestInterface;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressPrepareRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout\PayPalExpressPrepareRequestInterface;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\AuthorizationRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\CaptureRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\InquireRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\RefundRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\ReverseRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PrePlace\EasyCreditStatusRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\PrePlace\PrePlaceRequestInterface;
use SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck\CrifRequest;
use SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck\RiskCheckRequestInterface;
use SprykerEco\Zed\ComputopApi\ComputopApiDependencyProvider;
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface;

/**
 * @method \SprykerEco\Zed\ComputopApi\ComputopApiConfig getConfig()
 */
class ComputopApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface
     */
    public function getStoreFacade(): ComputopApiToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ComputopApiDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected function getComputopApiService(): ComputopApiServiceInterface
    {
        return $this->getProvidedDependency(ComputopApiDependencyProvider::SERVICE_COMPUTOP_API);
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ComputopApiBusinessMapperFactoryInterface
     */
    protected function createMapperFactory(): ComputopApiBusinessMapperFactoryInterface
    {
        return new ComputopApiBusinessMapperFactory();
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createAuthorizationPaymentRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new AuthorizationRequest(
            $this->createAuthorizeAdapter(),
            $this->createAuthorizeConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createAuthorizeCreditCardMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createAuthorizeEasyCreditMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createAuthorizePayPalMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createAuthorizePayNowMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createInquirePaymentRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new InquireRequest(
            $this->createInquireAdapter(),
            $this->createInquireConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createInquireCreditCardMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createInquirePayPalMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createInquireDirectDebitMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createInquirePaydirektMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createInquirePayNowMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createReversePaymentRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new ReverseRequest(
            $this->createReverseAdapter(),
            $this->createReverseConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createReverseCreditCardMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createReversePayPalMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createReverseDirectDebitMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createReversePaydirektMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createReversePayNowMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createCapturePaymentRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new CaptureRequest(
            $this->createCaptureAdapter(),
            $this->createCaptureConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createCaptureCreditCardMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCapturePayPalMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCaptureDirectDebitMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCapturePaydirektMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCaptureEasyCreditMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCaptureIdealMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createCapturePayNowMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createRefundPaymentRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new RefundRequest(
            $this->createRefundAdapter(),
            $this->createRefundConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundCreditCardMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundPayPalMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundDirectDebitMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundSofortMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundPaydirektMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundEasyCreditMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundIdealMapper());
        $paymentRequest->registerMapper($this->createMapperFactory()->createRefundPayNowMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PrePlace\PrePlaceRequestInterface
     */
    public function createEasyCreditStatusRequest(): PrePlaceRequestInterface
    {
        $paymentRequest = new EasyCreditStatusRequest(
            $this->createEasyCreditStatusAdapter(),
            $this->createEasyCreditStatusConverter(),
            $this->createMapperFactory()->createStatusEasyCreditMapper()
        );

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\PostPlace\PostPlaceRequestInterface
     */
    public function createEasyCreditAuthorizeRequest(): PostPlaceRequestInterface
    {
        $paymentRequest = new AuthorizationRequest(
            $this->createEasyCreditAuthorizeAdapter(),
            $this->createAuthorizeConverter()
        );

        $paymentRequest->registerMapper($this->createMapperFactory()->createAuthorizeEasyCreditMapper());

        return $paymentRequest;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck\RiskCheckRequestInterface
     */
    public function createCrifRequest(): RiskCheckRequestInterface
    {
        return new CrifRequest(
            $this->createCrifAdapter(),
            $this->createCrifConverter(),
            $this->createMapperFactory()->createCrifMapper()
        );
    }

    /**
     * @return PayPalExpressPrepareRequestInterface
     */
    public function createPayPalExpressPrepareRequest(): PayPalExpressPrepareRequestInterface
    {
        return new PayPalExpressPrepareRequest(
            $this->createPayPalExpressPrepareAdapter(),
            $this->createPayPalExpressPrepareConverter(),
            $this->createMapperFactory()->createPayPalExpressPrepareMapper()
        );
    }

    /**
     * @return PayPalExpressCompleteRequestInterface
     */
    public function createPayPalExpressCompleteRequest(): PayPalExpressCompleteRequestInterface
    {
        return new PayPalExpressCompleteRequest(
            $this->createPayPalExpressCompleteAdapter(),
            $this->createPayPalExpressCompleteConverter(),
            $this->createMapperFactory()->createPayPalExpressCompleteMapper()
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createAuthorizeConverter(): ConverterInterface
    {
        return new AuthorizeConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createReverseConverter(): ConverterInterface
    {
        return new ReverseConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createInquireConverter(): ConverterInterface
    {
        return new InquireConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createCaptureConverter(): ConverterInterface
    {
        return new CaptureConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createRefundConverter(): ConverterInterface
    {
        return new RefundConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createEasyCreditStatusConverter(): ConverterInterface
    {
        return new EasyCreditStatusConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createCrifConverter(): ConverterInterface
    {
        return new CrifConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createPayPalExpressPrepareConverter(): ConverterInterface
    {
        return new PayPalExpressPrepareConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    public function createPayPalExpressCompleteConverter(): ConverterInterface
    {
        return new PayPalExpressCompleteConverter($this->getComputopApiService(), $this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createAuthorizeAdapter(): AdapterInterface
    {
        return new AuthorizeAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createReverseAdapter(): AdapterInterface
    {
        return new ReverseAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createInquireAdapter(): AdapterInterface
    {
        return new InquireAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createCaptureAdapter(): AdapterInterface
    {
        return new CaptureAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createRefundAdapter(): AdapterInterface
    {
        return new RefundAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createEasyCreditStatusAdapter(): AdapterInterface
    {
        return new EasyCreditStatusAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createEasyCreditAuthorizeAdapter(): AdapterInterface
    {
        return new EasyCreditAuthorizeAdapter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected function createCrifAdapter(): AdapterInterface
    {
        return new CrifApiAdapter($this->getConfig());
    }

    /**
     * @return AdapterInterface
     */
    protected function createPayPalExpressPrepareAdapter(): AdapterInterface
    {
        return new PayPalExpressPrepareAdapter($this->getConfig());
    }

    /**
     * @return AdapterInterface
     */
    protected function createPayPalExpressCompleteAdapter(): AdapterInterface
    {
        return new PayPalExpressCompleteAdapter($this->getConfig());
    }
}
