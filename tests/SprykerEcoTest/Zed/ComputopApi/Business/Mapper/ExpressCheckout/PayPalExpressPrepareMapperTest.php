<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\ExpressCheckout;

use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressPrepareMapper;

class PayPalExpressPrepareMapperTest extends AbstractPayPalExpressMapperTest
{
    /**
     * @var \SprykerEcoTest\Zed\ComputopApi\ComputopApiZedTester
     */
    protected $tester;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface
     */
    protected function createMapper(): PayPalExpressMapperInterface
    {
        return new PayPalExpressPrepareMapper(
            $this->createComputopApiConfigMock()
        );
    }
}
