<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use Codeception\TestCase\Test;
use Spryker\Service\UtilText\UtilTextService;
use SprykerEco\Service\ComputopApi\ComputopApiConfig;
use SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverter;
use SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapper;

class ComputopApiServiceTestHelper extends Test
{
    const PASSWORD = 'password';

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function createComputopConfigMock()
    {
        $configMock = $this->createPartialMock(
            ComputopApiConfig::class,
            ['getHmacPassword']
        );

        $configMock->method('getHmacPassword')
            ->willReturn(self::PASSWORD);

        return $configMock;
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapperInterface
     */
    public function createMapper()
    {
        return new ComputopApiMapper(
            $this->createComputopConfigMock(),
            $this->createTextService()
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverterInterface
     */
    public function createConverter()
    {
        return new ComputopApiConverter($this->createComputopConfigMock());
    }

    /**
     * @return \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected function createTextService()
    {
        return new UtilTextService();
    }
}
