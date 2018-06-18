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
 * @group ReverseConverterTest
 */
class ReverseConverterTest extends AbstractConverterTest
{
    /**
     * @return void
     */
    public function testToTransactionResponseTransfer()
    {
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        /** @var \Generated\Shared\Transfer\ComputopApiReverseResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $responseTransfer->getHeader());
        $this->assertEquals(ConverterTestConstants::A_ID_VALUE, $responseTransfer->getAId());
        $this->assertEquals(ConverterTestConstants::TRANSACTION_ID_VALUE, $responseTransfer->getTransactionId());
        $this->assertEquals(ConverterTestConstants::CODE_EXT_VALUE, $responseTransfer->getCodeExt());
        $this->assertEquals(ConverterTestConstants::ERROR_TEXT_VALUE, $responseTransfer->getErrorText());
        $this->assertEquals(ConverterTestConstants::REF_NR_VALUE, $responseTransfer->getRefNr());
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
        $decryptedArray[ComputopApiConfig::CODE_EXT] = ConverterTestConstants::CODE_EXT_VALUE;
        $decryptedArray[ComputopApiConfig::ERROR_TEXT] = ConverterTestConstants::ERROR_TEXT_VALUE;
        $decryptedArray[ComputopApiConfig::REF_NR] = ConverterTestConstants::REF_NR_VALUE;

        return $decryptedArray;
    }
}
