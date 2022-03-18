<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use Codeception\TestCase\Test;
use Spryker\Service\UtilText\UtilTextService;
use SprykerEco\Service\ComputopApi\ComputopApiConfig;
use SprykerEco\Service\ComputopApi\Converter\ComputopApiConverter;
use SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceBridge;
use SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapper;

class ComputopApiServiceTestHelper extends Test
{
    /**
     * @var string
     */
    public const PASSWORD = 'password';

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    public function createComputopConfigMock()
    {
        $configMock = $this->createPartialMock(
            ComputopApiConfig::class,
            ['getHmacPassword'],
        );

        $configMock->method('getHmacPassword')
            ->willReturn(static::PASSWORD);

        return $configMock;
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface
     */
    public function createMapper()
    {
        return new ComputopApiMapper(
            $this->createComputopConfigMock(),
            $this->createTextService(),
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Converter\ComputopApiConverterInterface
     */
    public function createConverter()
    {
        return new ComputopApiConverter($this->createComputopConfigMock());
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceBridge
     */
    protected function createTextService(): ComputopApiToUtilTextServiceBridge
    {
        return new ComputopApiToUtilTextServiceBridge(new UtilTextService());
    }
}
