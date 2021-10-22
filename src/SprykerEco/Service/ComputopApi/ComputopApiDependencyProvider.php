<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceBridge;

class ComputopApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_TEXT = 'SERVICE_UTIL_TEXT';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container): Container
    {
        $container = parent::provideServiceDependencies($container);
        $container = $this->addComputopApiToUtilTextService($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addComputopApiToUtilTextService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_TEXT, function (Container $container) {
            return new ComputopApiToUtilTextServiceBridge($container->getLocator()->utilText()->service());
        });

        return $container;
    }
}
