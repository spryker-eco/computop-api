<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi;

use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreBridge;

class ComputopApiDependencyProvider extends AbstractBundleDependencyProvider
{
    const STORE = 'STORE';
    const SERVICE_COMPUTOP_API = 'SERVICE_COMPUTOP_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container[self::SERVICE_COMPUTOP_API] = function () use ($container) {
            return $container->getLocator()->computopApi()->service();
        };

        $container[self::STORE] = function () {
            return new ComputopApiToStoreBridge(Store::getInstance());
        };

        return $container;
    }
}
