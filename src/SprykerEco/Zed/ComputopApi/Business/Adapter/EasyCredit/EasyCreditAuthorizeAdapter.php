<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter\EasyCredit;

use SprykerEco\Zed\ComputopApi\Business\Adapter\AbstractAdapter;

class EasyCreditAuthorizeAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->config->getEasyCreditAuthorizeUrl();
    }
}
