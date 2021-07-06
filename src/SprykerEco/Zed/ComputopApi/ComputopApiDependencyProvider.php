<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeBridge;

class ComputopApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_STORE = 'FACADE_STORE';
    public const SERVICE_COMPUTOP_API = 'SERVICE_COMPUTOP_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container->set(static::SERVICE_COMPUTOP_API, function (Container $container) {
            return $container->getLocator()->computopApi()->service();
        });

        $container->set(static::FACADE_STORE, function (Container $container) {
            return new ComputopApiToStoreFacadeBridge($container->getLocator()->store()->facade());
        });

        return $container;
    }
}
