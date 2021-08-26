<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter\Inquire;

use SprykerEco\Zed\ComputopApi\Business\Converter\InquireConverter;
use SprykerEcoTest\Zed\ComputopApi\Business\Converter\AbstractConverterTest;

abstract class AbstractInquireConverterTest extends AbstractConverterTest
{
    /**
     * @return array
     */
    abstract protected function getDecryptedArray();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Converter\InquireConverter
     */
    protected function createConverter()
    {
        $computopServiceMock = $this->helper->createComputopApiServiceMock($this->getDecryptedArray());
        $configMock = $this->helper->createComputopApiConfigMock();

        $converter = new InquireConverter($computopServiceMock, $configMock);

        return $converter;
    }
}
