<?php

namespace SprykerEco\Client\ComputopApi;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\ComputopApi\Zed\ComputopApiStub;

class ComputopApiFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Client\ComputopApi\Zed\ComputopApiStubInterface
     */
    public function createZedStub()
    {
        return new ComputopApiStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(ComputopApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
