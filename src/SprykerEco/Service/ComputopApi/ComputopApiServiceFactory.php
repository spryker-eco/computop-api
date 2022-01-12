<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerEco\Service\ComputopApi\Converter\ComputopApiConverter;
use SprykerEco\Service\ComputopApi\Converter\ComputopApiConverterInterface;
use SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasher;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface;
use SprykerEco\Service\ComputopApi\Hasher\HmacHasher;
use SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface;
use SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapper;
use SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface;

/**
 * @method \SprykerEco\Service\ComputopApi\ComputopApiConfig getConfig()
 */
class ComputopApiServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface
     */
    public function createBlowfishHasher(): BlowfishHasherInterface
    {
        return new BlowfishHasher();
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Converter\ComputopApiConverterInterface
     */
    public function createComputopApiConverter(): ComputopApiConverterInterface
    {
        return new ComputopApiConverter(
            $this->getConfig(),
            $this->createComputopApiMapper(),
            $this->createHmacHasher(),
            $this->createBlowfishHasher(),
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Mapper\ComputopApiMapperInterface
     */
    public function createComputopApiMapper(): ComputopApiMapperInterface
    {
        return new ComputopApiMapper(
            $this->getConfig(),
            $this->getUtilTextService(),
            $this->createBlowfishHasher(),
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface
     */
    public function getUtilTextService(): ComputopApiToUtilTextServiceInterface
    {
        /** @var \SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface $utilTextService */
        $utilTextService = $this->getProvidedDependency(ComputopApiDependencyProvider::SERVICE_UTIL_TEXT);

        return $utilTextService;
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface
     */
    public function createHmacHasher(): HmacHasherInterface
    {
        return new HmacHasher($this->getConfig());
    }
}
