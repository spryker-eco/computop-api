<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressPrepareConverter;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\AbstractConverterTest;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\ConverterTestConstants;

class PayPalExpressPrepareConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testGetResponseTransfer(): void
    {
        //Arrange
        $expectedResponseBody = ComputopApiConfig::ORDER_ID . '=' . ConverterTestConstants::ORDER_ID_VALUE;
        $response = $this->helper->prepareUnencryptedResponse($expectedResponseBody);
        $service = $this->createConverter($this->getDecryptedArray());

        //Act
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        //Assert
        $this->assertInstanceOf(ComputopApiPayPalExpressPrepareResponseTransfer::class, $responseTransfer);
        $this->assertSame(ConverterTestConstants::ORDER_ID_VALUE, $responseTransfer->getOrderid());
    }

    /**
     * @return void
     */
    public function testNegativeGetResponseTransfer(): void
    {
        //Arrange
        $expectedResponseBody = 'error';
        $response = $this->helper->prepareUnencryptedResponse($expectedResponseBody);
        $service = $this->createConverter($this->getDecryptedArray());

        //Act
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        //Assert
        $this->assertInstanceOf(ComputopApiPayPalExpressPrepareResponseTransfer::class, $responseTransfer);
        $this->assertNotSame(ConverterTestConstants::ORDER_ID_VALUE, $responseTransfer->getOrderid());
    }

    /**
     * @param array $decryptedArrayExample
     *
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressPrepareConverter
     */
    protected function createConverter(array $decryptedArrayExample): PayPalExpressPrepareConverter
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($decryptedArrayExample);
        $configMock = $this->helper->createComputopApiConfigMock();
        $converter = new PayPalExpressPrepareConverter($computopServiceMock, $configMock);

        return $converter;
    }

    /**
     * @return array
     */
    protected function getDecryptedArray(): array
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::ORDER_ID] = ConverterTestConstants::ORDER_ID_VALUE;

        return $decryptedArray;
    }

    /**
     * @return array
     */
    protected function getNegativeDecryptedArray(): array
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::ORDER_ID] = 'anotherValue';

        return $decryptedArray;
    }
}
