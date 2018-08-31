<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business;

use Codeception\TestCase\Test;

abstract class AbstractSetUpTest extends Test
{
    /**
     * @var \SprykerEcoTest\Zed\ComputopApi\Business\FacadeTestHelper
     */
    protected $helper;

    /**
     * @param \SprykerEcoTest\Zed\ComputopApi\Business\FacadeTestHelper $helper
     *
     * @return void
     */
    protected function _inject(FacadeTestHelper $helper)
    {
        $this->helper = $helper;
    }
}
