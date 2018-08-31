<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Converter\RefundConverter;

/**
 * @group Unit
 * @group SprykerEco
 * @group Zed
 * @group ComputopApi
 * @group Api
 * @group Converter
 * @group RefundConverterTest
 */
class RefundConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testToTransactionResponseTransfer()
    {
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        /** @var \Generated\Shared\Transfer\ComputopApiRefundResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $responseTransfer->getHeader());
        $this->assertEquals(ComputopApiConfig::A_ID, $responseTransfer->getAId());
        $this->assertEquals(ComputopApiConfig::TRANSACTION_ID, $responseTransfer->getTransactionId());
        $this->assertEquals(ComputopApiConfig::AMOUNT, $responseTransfer->getAmount());
        $this->assertEquals(ComputopApiConfig::CODE_EXT, $responseTransfer->getCodeExt());
        $this->assertEquals(ComputopApiConfig::ERROR_TEXT, $responseTransfer->getErrorText());
        $this->assertEquals(ComputopApiConfig::REF_NR, $responseTransfer->getRefNr());
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\RefundConverter
     */
    protected function createConverter()
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($this->getDecryptedArray());
        $configMock = $this->helper->createComputopApiConfigMock();

        $converter = new RefundConverter($computopServiceMock, $configMock);

        return $converter;
    }

    /**
     * @return array
     */
    protected function getDecryptedArray()
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();

        $decryptedArray[ComputopApiConfig::A_ID] = ConverterTestConstants::A_ID_VALUE;
        $decryptedArray[ComputopApiConfig::TRANSACTION_ID] = ConverterTestConstants::TRANSACTION_ID_VALUE;
        $decryptedArray[ComputopApiConfig::AMOUNT] = ConverterTestConstants::AMOUNT_VALUE_NOT_ZERO;
        $decryptedArray[ComputopApiConfig::CODE_EXT] = ConverterTestConstants::CODE_EXT_VALUE;
        $decryptedArray[ComputopApiConfig::ERROR_TEXT] = ConverterTestConstants::ERROR_TEXT_VALUE;
        $decryptedArray[ComputopApiConfig::REF_NR] = ConverterTestConstants::REF_NR_VALUE;

        return $decryptedArray;
    }
}
