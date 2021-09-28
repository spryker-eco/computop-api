<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use Codeception\TestCase\Test;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiSharedConfig;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
use SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard\CreditCardMapperTestConstants;

abstract class AbstractPayPalExpressMapperTest extends Test
{
    /**
     * @var \SprykerEcoTest\Zed\ComputopApi\ComputopApiZedTester
     */
    protected $tester;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface
     */
    abstract protected function createMapper(): PayPalExpressMapperInterface;

    /**
     * @return void
     */
    public function testBuildRequestWithQuoteTransferReturnsArray(): void
    {
        //Arrange
        $quoteTransfer = $this->tester->createQuoteTransfer();
        $mapper = $this->createMapper();

        //Act
        $mappedData = $mapper->mapQuoteTransferToRequestArray($quoteTransfer);

        //Assert
        $this->assertSame(CreditCardMapperTestConstants::DATA_VALUE, $mappedData[ComputopApiConfig::DATA]);
        $this->assertSame(CreditCardMapperTestConstants::LENGTH_VALUE, $mappedData[ComputopApiConfig::LENGTH]);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected function createComputopApiConfigMock()
    {
        $configMock = $this->createPartialMock(
            \SprykerEco\Zed\ComputopApi\ComputopApiConfig::class,
            ['getBlowfishPass']
        );

        return $configMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Service\ComputopApi\ComputopApiService
     */
    protected function createComputopApiServiceMock()
    {
        $encryptedArray = [
            ComputopApiSharedConfig::LENGTH => CreditCardMapperTestConstants::LENGTH_VALUE,
            ComputopApiSharedConfig::DATA => CreditCardMapperTestConstants::DATA_VALUE,
        ];

        $computopServiceMock = $this->createPartialMock(
            ComputopApiService::class,
            [
                'getEncryptedArray',
            ]
        );

        $computopServiceMock->method('getEncryptedArray')
            ->willReturn($encryptedArray);

        return $computopServiceMock;
    }
}
