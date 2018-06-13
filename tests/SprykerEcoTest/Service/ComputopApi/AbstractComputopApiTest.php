<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use Codeception\TestCase\Test;
use SprykerEcoTest\Service\ComputopApi\Mapper\ComputopApiMapperTestHelper;

abstract class AbstractComputopApiTest extends Test
{
    /**
     * @var \SprykerEcoTest\Service\ComputopApi\ComputopApiServiceTestHelper
     */
    protected $helper;

    /**
     * @var \SprykerEcoTest\Service\ComputopApi\Mapper\ComputopApiMapperTestHelper
     */
    protected $mapperHelper;

    /**
     * @param \SprykerEcoTest\Service\ComputopApi\ComputopApiServiceTestHelper $helper
     * @param \SprykerEcoTest\Service\ComputopApi\Mapper\ComputopApiMapperTestHelper $mapperHelper
     *
     * @return void
     */
    protected function _inject(ComputopApiServiceTestHelper $helper, ComputopApiMapperTestHelper $mapperHelper)
    {
        $this->helper = $helper;
        $this->mapperHelper = $mapperHelper;
    }
}
