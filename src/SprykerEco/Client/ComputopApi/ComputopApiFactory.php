<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopApi;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\ComputopApi\Dependency\Client\ComputopApiToZedRequestClientInterface;
use SprykerEco\Client\ComputopApi\Zed\ComputopApiStub;
use SprykerEco\Client\ComputopApi\Zed\ComputopApiStubInterface;

class ComputopApiFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Client\ComputopApi\Zed\ComputopApiStubInterface
     */
    public function createZedStub(): ComputopApiStubInterface
    {
        return new ComputopApiStub($this->getZedRequestClient());
    }

    /**
     * @return \SprykerEco\Client\ComputopApi\Dependency\Client\ComputopApiToZedRequestClientInterface
     */
    public function getZedRequestClient(): ComputopApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ComputopApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
