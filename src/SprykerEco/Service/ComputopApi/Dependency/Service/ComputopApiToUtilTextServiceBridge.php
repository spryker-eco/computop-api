<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Dependency\Service;

class ComputopApiToUtilTextServiceBridge implements ComputopApiToUtilTextServiceInterface
{
    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $utilTextService
     */
    public function __construct($utilTextService)
    {
        $this->utilTextService = $utilTextService;
    }

    /**
     * @param mixed $value
     * @param string $algorithm
     *
     * @return string
     */
    public function hashValue($value, $algorithm): string
    {
        return $this->utilTextService->hashValue($value, $algorithm);
    }
}
