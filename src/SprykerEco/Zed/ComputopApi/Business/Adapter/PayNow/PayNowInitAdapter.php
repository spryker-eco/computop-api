<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter\PayNow;

use SprykerEco\Zed\ComputopApi\Business\Adapter\AbstractAdapter;

class PayNowInitAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->config->getPayNowInitActionUrl();
    }
}
