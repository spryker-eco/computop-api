<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressCompleteConverter;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\AbstractConverterTest;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\ConverterTestConstants;

class PayPalExpressCompleteConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testGetResponseTransfer()
    {
        //Arrange
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        //Act
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        //Assert
        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $responseTransfer->getHeader());
        $this->assertEquals(ConverterTestConstants::REF_NR_VALUE, $responseTransfer->getRefNr());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressCompleteConverter
     */
    protected function createConverter()
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($this->getDecryptedArray());
        $configMock = $this->helper->createComputopApiConfigMock();

        $converter = new PayPalExpressCompleteConverter($computopServiceMock, $configMock);

        return $converter;
    }

    /**
     * @return array
     */
    protected function getDecryptedArray()
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::REF_NR] = ConverterTestConstants::REF_NR_VALUE;

        return $decryptedArray;
    }
}
