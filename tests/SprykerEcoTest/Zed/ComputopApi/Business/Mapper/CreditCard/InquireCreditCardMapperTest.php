<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard;

use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\CreditCard\InquireCreditCardMapper;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;

/**
 * @group Unit
 * @group SprykerEco
 * @group Zed
 * @group ComputopApi
 * @group Api
 * @group Mapper
 * @group InquireCreditCardMapperTest
 */
class InquireCreditCardMapperTest extends AbstractCreditCardMapperTest
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    protected function createMapper(): PostPlaceMapperInterface
    {
        return new InquireCreditCardMapper(
            $this->helper->createComputopApiServiceMock(),
            $this->helper->createComputopApiConfigMock(),
            $this->helper->createStoreMock()
        );
    }
}
