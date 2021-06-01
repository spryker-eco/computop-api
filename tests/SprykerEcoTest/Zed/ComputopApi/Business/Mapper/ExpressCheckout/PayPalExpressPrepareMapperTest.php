<?php

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressPrepareMapper;

class PayPalExpressPrepareMapperTest extends AbstractPayPalExpressMapperTest
{
    protected function createMapper()
    {
        return new PayPalExpressPrepareMapper(
            $this->helper->createComputopApiServiceMock(),
            $this->helper->createComputopApiConfigMock()
        );
    }
}
