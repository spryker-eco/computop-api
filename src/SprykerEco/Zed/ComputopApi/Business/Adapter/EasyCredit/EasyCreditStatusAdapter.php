<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter\EasyCredit;

use SprykerEco\Zed\ComputopApi\Business\Adapter\AbstractAdapter;

class EasyCreditStatusAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getEasyCreditStatusUrl();
    }
}
