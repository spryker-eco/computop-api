<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerEco\Service\ComputopApi\Model\BlowfishHasher;
use SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverter;
use SprykerEco\Service\ComputopApi\Model\HmacHasher;
use SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapper;

class ComputopApiServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerEco\Service\ComputopApi\Model\BlowfishHasherInterface
     */
    public function createBlowfishHasher()
    {
        return new BlowfishHasher();
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Converter\ComputopApiConverterInterface
     */
    public function createComputopApiConverter()
    {
        return new ComputopApiConverter($this->getConfig());
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\Mapper\ComputopApiMapperInterface
     */
    public function createComputopApiMapper()
    {
        return new ComputopApiMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Model\HmacHasherInterface
     */
    public function createHmacHasher()
    {
        return new HmacHasher($this->getConfig());
    }
}
