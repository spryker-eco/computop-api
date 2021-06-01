<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopApi;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
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
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(ComputopApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
