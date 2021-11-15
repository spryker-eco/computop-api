<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business;

use Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCrifResponseTransfer;
use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use Generated\Shared\Transfer\ComputopApiInquireResponseTransfer;
use Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer;
use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Generated\Shared\Transfer\ComputopApiRefundResponseTransfer;
use Generated\Shared\Transfer\ComputopApiReverseResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\ComputopApiFacade;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group ComputopApi
 * @group Business
 */
class FacadeTest extends AbstractSetUpTest
{
    /**
     * @return void
     */
    public function testPerformEasyCreditStatusRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performEasyCreditStatusRequest(
            $this->helper->getQuoteTrasfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiEasyCreditStatusResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformAuthorizationRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performAuthorizationRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiAuthorizeResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformCaptureRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performCaptureRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiCaptureResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformInquireRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performInquireRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiInquireResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformRefundRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performRefundRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiRefundResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformReverseRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performReverseRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiReverseResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformCrifApiCall()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performCrifApiCall(
            $this->helper->getQuoteTrasfer(),
        );

        $this->assertInstanceOf(ComputopApiCrifResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
        $this->assertSame(FacadeTestConstants::CRIF_GREEN_RESULT, $response->getResult());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getCode());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getStatus());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE_SUCCESS, $response->getDescription());
    }

    /**
     * @return void
     */
    public function testPerformEasyCreditAuthorizeRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $response = $facade->performEasyCreditAuthorizeRequest(
            $this->helper->getOrderTransfer(),
            $this->helper->createComputopApiHeaderPaymentTransfer(),
        );

        $this->assertInstanceOf(ComputopApiAuthorizeResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }

    /**
     * @return void
     */
    public function testPerformPayPalExpressPrepareApiCall(): void
    {
        //Arrange
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $quote = $facade->performPayPalExpressPrepareApiCall(
            $this->helper->getPayPalExpressQuoteTransfer(),
        );

        //Act
        $response = $quote->getPayment()->getComputopPayPalExpress()->getPayPalExpressPrepareResponse();

        //Assert
        $this->assertInstanceOf(ComputopApiPayPalExpressPrepareResponseTransfer::class, $response);
        $this->assertNotEmpty($response->getOrderid());
    }

    /**
     * @return void
     */
    public function testPerformPayPalExpressCompleteApiCall(): void
    {
        //Arrange
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->helper->createFactory());
        $quote = $facade->performPayPalExpressCompleteApiCall(
            $this->helper->getPayPalExpressQuoteTransfer(),
        );

        //Act
        $response = $quote->getPayment()->getComputopPayPalExpress()->getPayPalExpressCompleteResponse();

        //Assert
        $this->assertInstanceOf(ComputopApiPayPalExpressCompleteResponseTransfer::class, $response);
        $this->assertTrue($response->getHeader()->getIsSuccess());
        $this->assertSame(FacadeTestConstants::STATUS_VALUE, $response->getHeader()->getStatus());
        $this->assertSame(FacadeTestConstants::CODE_VALUE, $response->getHeader()->getCode());
        $this->assertNotEmpty($response->getHeader()->getTransId());
        $this->assertNotEmpty($response->getHeader()->getPayId());
    }
}
