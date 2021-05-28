<?php

namespace SprykerEco\Zed\ComputopApi\Business\Adapter\ExpressCheckout;

use SprykerEco\Zed\ComputopApi\Business\Adapter\AbstractAdapter;

class PayPalExpressPrepareAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getPayPalExpressPrepareActionUrl();
    }
}
