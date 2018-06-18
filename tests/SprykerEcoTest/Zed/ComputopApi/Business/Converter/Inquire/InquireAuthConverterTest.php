<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\Inquire;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\ConverterTestConstants;

/**
 * @group Unit
 * @group SprykerEco
 * @group Zed
 * @group ComputopApi
 * @group Api
 * @group Converter
 * @group InquireAuthConverterTest
 */
class InquireAuthConverterTest extends AbstractInquireConverterTest
{
    /**
     * @return void
     */
    public function testToTransactionResponseTransfer()
    {
        $response = $this->helper->prepareResponse();
        $service = $this->createConverter();

        /** @var \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer $responseTransfer */
        $responseTransfer = $service->toTransactionResponseTransfer($response);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $responseTransfer->getHeader());
//        $this->assertTrue($responseTransfer->getIsAuthLast());//ToDo:add if need
    }

    /**
     * @return array
     */
    protected function getDecryptedArray()
    {
        $decryptedArray = $this->helper->getMainDecryptedArray();

        $decryptedArray[ComputopApiConfig::AMOUNT_AUTH] = ConverterTestConstants::AMOUNT_VALUE_NOT_ZERO;
        $decryptedArray[ComputopApiConfig::AMOUNT_CAP] = ConverterTestConstants::AMOUNT_VALUE_ZERO;
        $decryptedArray[ComputopApiConfig::AMOUNT_CRED] = ConverterTestConstants::AMOUNT_VALUE_ZERO;

        return $decryptedArray;
    }
}
