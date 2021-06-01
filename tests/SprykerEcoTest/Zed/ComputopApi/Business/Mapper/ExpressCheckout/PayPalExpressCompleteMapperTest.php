<?php

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressCompleteMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;

class PayPalExpressCompleteMapperTest extends AbstractPayPalExpressMapperTest
{
    /**
     * @return PayPalExpressMapperInterface
     */
    protected function createMapper()
    {
        return new PayPalExpressCompleteMapper(
            $this->helper->createComputopApiServiceMock(),
            $this->helper->createComputopApiConfigMock()
        );
    }
}
