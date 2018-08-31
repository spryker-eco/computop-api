<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter\RiskCheck;

use SprykerEco\Zed\ComputopApi\Business\Adapter\AbstractAdapter;

class CrifApiAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getCrifActionUrl();
    }
}
