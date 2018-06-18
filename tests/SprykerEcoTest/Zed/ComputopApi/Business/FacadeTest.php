<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business;

use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use SprykerEco\Zed\ComputopApi\Business\ComputopApiFacade;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group ComputopApi
 * @group Business
 */
class FacadeTest extends AbstractSetUpTest
{
    /**
     * @return void
     */
    public function testPerformEasyCreditStatusRequest()
    {
        $facade = new ComputopApiFacade();
        $facade->setFactory($this->createFactory());
        $response = $facade->performEasyCreditStatusRequest(
            $this->getQuoteTrasfer(),
            $this->createComputopApiHeaderPaymentTransfer()
        );

        $this->assertInstanceOf(ComputopApiEasyCreditStatusResponseTransfer::class, $response);
    }
}
