<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter;

class RefundAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->config->getRefundAction();
    }
}
