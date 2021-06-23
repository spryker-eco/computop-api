<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressCompleteMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;

class PayPalExpressCompleteMapperTest extends AbstractPayPalExpressMapperTest
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface
     */
    protected function createMapper(): PayPalExpressMapperInterface
    {
        return new PayPalExpressCompleteMapper(
            $this->helper->createComputopApiServiceMock(),
            $this->helper->createComputopApiConfigMock()
        );
    }
}