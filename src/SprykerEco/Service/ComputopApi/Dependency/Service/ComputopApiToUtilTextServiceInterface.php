<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Dependency\Service;

interface ComputopApiToUtilTextServiceInterface
{
    /**
     * @param mixed $value
     * @param string $algorithm
     *
     * @return string
     */
    public function hashValue($value, $algorithm): string;
}
