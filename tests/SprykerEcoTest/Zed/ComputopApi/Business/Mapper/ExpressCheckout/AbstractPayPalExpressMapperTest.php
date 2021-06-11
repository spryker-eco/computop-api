<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Codeception\TestCase\Test;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard\CreditCardMapperTestConstants;

abstract class AbstractPayPalExpressMapperTest extends Test
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface
     */
    abstract protected function createMapper();

    /**
     * @var \SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperTestHelper
     */
    protected $helper;

    /**
     * @return void
     */
    public function testBuildRequestWithQuoteTransferReturnsArray(): void
    {
        //Arrange
        $quoteTransfer = $this->helper->createQuoteTransfer();
        $mapper = $this->createMapper();

        //Act
        $mappedData = $mapper->buildRequest($quoteTransfer);

        //Assert
        $this->assertEquals(CreditCardMapperTestConstants::DATA_VALUE, $mappedData[ComputopApiConfig::DATA]);
        $this->assertEquals(CreditCardMapperTestConstants::LENGTH_VALUE, $mappedData[ComputopApiConfig::LENGTH]);
    }

    /**
     * @param \SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperTestHelper $helper
     *
     * @return void
     */
    protected function _inject(PayPalExpressMapperTestHelper $helper): void
    {
        $this->helper = $helper;
    }
}
