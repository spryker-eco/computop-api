<?php

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressPrepareConverter;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\AbstractConverterTest;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\ConverterTestConstants;

class PayPalExpressPrepareConverterTest extends AbstractConverterTest
{
    public function testGetResponseTransfer()
    {
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        $this->assertEquals(ConverterTestConstants::ORDER_ID_VALUE, $responseTransfer->getOrderId());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressPrepareConverter
     */
    protected function createConverter()
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($this->getDecryptedArray());
        $configMock = $this->helper->createComputopApiConfigMock();

        $converter = new PayPalExpressPrepareConverter($computopServiceMock, $configMock);

        return $converter;
    }

    /**
     * @return array
     */
    protected function getDecryptedArray()
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::ORDER_ID] = ConverterTestConstants::ORDER_ID_VALUE;

        return $decryptedArray;
    }
}
