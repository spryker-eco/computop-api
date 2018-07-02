<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Service\UtilText\UtilTextService;
use Spryker\Service\UtilText\UtilTextServiceInterface;
use SprykerEco\Service\ComputopApi\Model\BlowfishHasher;
use SprykerEco\Service\ComputopApi\Model\BlowfishHasherInterface;
use SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverter;
use SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverterInterface;
use SprykerEco\Service\ComputopApi\Model\HmacHasher;
use SprykerEco\Service\ComputopApi\Model\HmacHasherInterface;
use SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapper;
use SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapperInterface;

/**
 * @method \SprykerEco\Service\ComputopApi\ComputopApiConfig getConfig()
 */
class ComputopApiServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerEco\Service\ComputopApi\Model\BlowfishHasherInterface
     */
    public function createBlowfishHasher(): BlowfishHasherInterface
    {
        return new BlowfishHasher();
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverterInterface
     */
    public function createComputopApiConverter(): ComputopApiConverterInterface
    {
        return new ComputopApiConverter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapperInterface
     */
    public function createComputopApiMapper(): ComputopApiMapperInterface
    {
        return new ComputopApiMapper(
            $this->getConfig(),
            $this->createTextService()
        );
    }

    /**
     * @return \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    public function createTextService(): UtilTextServiceInterface
    {
        return new UtilTextService();
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\HmacHasherInterface
     */
    public function createHmacHasher(): HmacHasherInterface
    {
        return new HmacHasher($this->getConfig());
    }
}
