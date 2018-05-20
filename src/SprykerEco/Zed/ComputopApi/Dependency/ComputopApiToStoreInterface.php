<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Dependency;

interface ComputopApiToStoreInterface
{
    /**
     * @return string
     */
    public function getCurrencyIsoCode();
}