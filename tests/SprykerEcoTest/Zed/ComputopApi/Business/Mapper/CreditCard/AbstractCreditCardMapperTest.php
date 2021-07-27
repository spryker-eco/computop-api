<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard;

use Codeception\TestCase\Test;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;

abstract class AbstractCreditCardMapperTest extends Test
{
    /**
     * Return needed mapper
     *
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    abstract protected function createMapper(): PostPlaceMapperInterface;

    /**
     * @var \SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard\CreditCardMapperTestHelper
     */
    protected $helper;

    /**
     * @param \SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard\CreditCardMapperTestHelper $helper
     *
     * @return void
     */
    protected function _inject(CreditCardMapperTestHelper $helper): void
    {
        $this->helper = $helper;
    }

    /**
     * @return void
     */
    public function testBuildRequest(): void
    {
        $orderTransferMock = $this->helper->createOrderTransferMock();
        $computopApiHeaderPaymentTransfer = $this->helper->createComputopApiHeaderPaymentTransfer();

        $service = $this->createMapper();
        $mappedData = $service->buildRequest($orderTransferMock, $computopApiHeaderPaymentTransfer);

        $this->assertEquals(CreditCardMapperTestConstants::DATA_VALUE, $mappedData[ComputopApiConfig::DATA]);
        $this->assertEquals(CreditCardMapperTestConstants::LENGTH_VALUE, $mappedData[ComputopApiConfig::LENGTH]);
    }
}
