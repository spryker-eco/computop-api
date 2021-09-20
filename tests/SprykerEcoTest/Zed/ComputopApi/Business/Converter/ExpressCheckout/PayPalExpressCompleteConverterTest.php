<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\ExpressCheckout;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ExpressCheckout\PayPalExpressCompleteConverter;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\AbstractConverterTest;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\ConverterTestConstants;

class PayPalExpressCompleteConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testConvertDecryptedArrayResponseToTransactionResponseTransfer(): void
    {
        //Arrange
        $response = $this->helper->prepareResponse();
        $payPalExpressCompleteConverter = $this->createConverter($this->getDecryptedArray());

        //Act
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer $computopApiPayPalExpressCompleteResponseTransfer */
        $computopApiPayPalExpressCompleteResponseTransfer = $payPalExpressCompleteConverter->toTransactionResponseTransfer($response);

        //Assert
        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $computopApiPayPalExpressCompleteResponseTransfer->getHeader());
        $this->assertSame(ConverterTestConstants::REF_NR_VALUE, $computopApiPayPalExpressCompleteResponseTransfer->getRefNr());
    }

    /**
     * @return void
     */
    public function testNegativeConvertDecryptedArrayResponseToTransactionResponseTransfer(): void
    {
        //Arrange
        $response = $this->helper->prepareResponse();
        $payPalExpressCompleteConverter = $this->createConverter($this->getNegativeDecryptedArray());

        //Act
        /** @var \Generated\Shared\Transfer\ComputopApiPayPalExpressCompleteResponseTransfer $computopApiPayPalExpressCompleteResponseTransfer */
        $computopApiPayPalExpressCompleteResponseTransfer = $payPalExpressCompleteConverter->toTransactionResponseTransfer($response);

        //Assert
        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $computopApiPayPalExpressCompleteResponseTransfer->getHeader());
        $this->assertNotSame(ConverterTestConstants::REF_NR_VALUE, $computopApiPayPalExpressCompleteResponseTransfer->getRefNr());
    }

    /**
     * @param array $decryptedArrayExample
     *
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    protected function createConverter(array $decryptedArrayExample): ConverterInterface
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($decryptedArrayExample);
        $configMock = $this->helper->createComputopApiConfigMock();

        return new PayPalExpressCompleteConverter($computopServiceMock, $configMock);
    }

    /**
     * @return array
     */
    protected function getDecryptedArray(): array
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::REF_NR] = ConverterTestConstants::REF_NR_VALUE;

        return $decryptedArray;
    }

    /**
     * @return array
     */
    protected function getNegativeDecryptedArray(): array
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();
        $decryptedArray[ComputopApiConfig::REF_NR] = ConverterTestConstants::A_ID_VALUE;

        return $decryptedArray;
    }
}
