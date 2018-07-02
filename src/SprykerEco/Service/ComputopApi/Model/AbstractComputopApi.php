<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Model;

use SprykerEco\Service\ComputopApi\ComputopApiConfigInterface;

abstract class AbstractComputopApi
{
    protected const MAC_SEPARATOR = '*';
    protected const DATA_SEPARATOR = '&';
    protected const DATA_SUB_SEPARATOR = '=';

    /**
     * @var \Spryker\Service\Kernel\AbstractBundleConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfigInterface $config
     */
    public function __construct(ComputopApiConfigInterface $config)
    {
        $this->config = $config;
    }
}
