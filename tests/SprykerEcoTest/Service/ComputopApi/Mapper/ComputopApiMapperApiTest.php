<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi\Mapper;

use SprykerEcoTest\Service\ComputopApi\AbstractComputopApiTest;

/**
 * @group Unit
 * @group SprykerEco
 * @group Service
 * @group ComputopApi
 * @group Api
 * @group Mapper
 * @group ComputopApiMapperTest
 */
class ComputopApiMapperApiTest extends AbstractComputopApiTest
{
    /**
     * @return void
     */
    public function testMacValueMapper()
    {
        $mapper = $this->helper->createMapper();
        $cardPaymentTransfer = $this->mapperHelper->createComputopPaymentTransfer();
        $macValue = $mapper->getMacEncryptedValue($cardPaymentTransfer);

        $this->assertSame(ComputopApiMapperTestConstants::EXPECTED_MAC, $macValue);
    }

    /**
     * @return void
     */
    public function testMacResponseValueMapper()
    {
        $mapper = $this->helper->createMapper();
        $cardPaymentResponseTransfer = $this->mapperHelper->createComputopApiResponseHeaderTransfer();
        $macValue = $mapper->getMacResponseEncryptedValue($cardPaymentResponseTransfer);

        $this->assertSame(ComputopApiMapperTestConstants::EXPECTED_MAC_RESPONSE, $macValue);
    }

    /**
     * @return void
     */
    public function testPlaintextMapper()
    {
        $mapper = $this->helper->createMapper();
        $arrayForPlaintext = ['test_key' => 'test_value'];
        $plaintext = $mapper->getDataPlainText($arrayForPlaintext);

        $this->assertSame(ComputopApiMapperTestConstants::EXPECTED_PLAINTEXT, $plaintext);
    }
}
