<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Generated\Shared\Transfer\ComputopPayPalExpressPaymentTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiSharedConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard\CreditCardMapperTestConstants;

class PayPalExpressMapperTestHelper extends Test
{
    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createQuoteTransfer(): QuoteTransfer
    {
        $quoteTransfer = new QuoteTransfer();

        $paymentTransfer = new PaymentTransfer();
        $computopPayPalExpressPaymentTransfer = new ComputopPayPalExpressPaymentTransfer();
        $computopPayPalExpressPaymentTransfer->setData(PayPalExpressMapperTestConstants::DATA_VALUE);
        $computopPayPalExpressPaymentTransfer->setLen(PayPalExpressMapperTestConstants::LENGTH_VALUE);
        $payPalExpressPrepareResponse = new ComputopApiPayPalExpressPrepareResponseTransfer();
        $payPalExpressPrepareResponse->setTransID('');
        $computopPayPalExpressPaymentTransfer->setPayPalExpressPrepareResponse($payPalExpressPrepareResponse);
        $paymentTransfer->setComputopPayPalExpress($computopPayPalExpressPaymentTransfer);
        $quoteTransfer->setPayment($paymentTransfer);

        $totalsTransfer = new TotalsTransfer();
        $quoteTransfer->setTotals($totalsTransfer);

        return $quoteTransfer;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    public function createComputopApiConfigMock()
    {
        $configMock = $this->createPartialMock(
            ComputopApiConfig::class,
            ['getBlowfishPass']
        );

        return $configMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Service\ComputopApi\ComputopApiService
     */
    public function createComputopApiServiceMock()
    {
        $encryptedArray = [
            ComputopApiSharedConfig::LENGTH => CreditCardMapperTestConstants::LENGTH_VALUE,
            ComputopApiSharedConfig::DATA => CreditCardMapperTestConstants::DATA_VALUE,
        ];

        $computopServiceMock = $this->createPartialMock(
            ComputopApiService::class,
            [
                'getEncryptedArray',
            ]
        );

        $computopServiceMock->method('getEncryptedArray')
            ->willReturn($encryptedArray);

        return $computopServiceMock;
    }
}
