<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi\Mapper;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopCreditCardPaymentTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;

/**
 * @group Unit
 * @group SprykerEco
 * @group Service
 * @group ComputopApi
 * @group Api
 * @group Mapper
 * @group ComputopApiMapperTest
 */
class ComputopApiMapperTestHelper extends Test
{
    /**
     * @return \Generated\Shared\Transfer\ComputopCreditCardPaymentTransfer
     */
    public function createComputopPaymentTransfer()
    {
        $cardPaymentTransfer = new ComputopCreditCardPaymentTransfer();

        $cardPaymentTransfer
            ->setPayId(ComputopApiMapperTestConstants::PAY_ID_VALUE)
            ->setTransId(ComputopApiMapperTestConstants::TRANS_ID_VALUE)
            ->setMerchantId(ComputopApiMapperTestConstants::MERCHANT_ID_VALUE)
            ->setAmount(ComputopApiMapperTestConstants::AMOUNT_VALUE)
            ->setCurrency(ComputopApiMapperTestConstants::CURRENCY_VALUE);

        return $cardPaymentTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    public function createComputopApiResponseHeaderTransfer()
    {
        $compuropHeaderTransfer = new ComputopApiResponseHeaderTransfer();

        $compuropHeaderTransfer
            ->setPayId(ComputopApiMapperTestConstants::PAY_ID_VALUE)
            ->setTransId(ComputopApiMapperTestConstants::TRANS_ID_VALUE)
            ->setMId(ComputopApiMapperTestConstants::MERCHANT_ID_VALUE)
            ->setStatus(ComputopApiMapperTestConstants::STATUS_VALUE)
            ->setCode(ComputopApiMapperTestConstants::CODE_VALUE);

        return $compuropHeaderTransfer;
    }
}
