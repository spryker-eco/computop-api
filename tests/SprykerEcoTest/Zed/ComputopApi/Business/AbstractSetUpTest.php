<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Service\ComputopApi\ComputopApiServiceFactory;
use SprykerEco\Service\ComputopApi\ComputopApiConfig as ComputopApiServiceConfig;
use SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreBridge;

abstract class AbstractSetUpTest extends Test
{
    const ORDER_REFERENCE_VALUE = 'DE--1';
    const TRANS_ID_VALUE = 'TRANS_ID_VALUE';
    const PAY_ID_VALUE = 'PAY_ID_VALUE';
    const AMOUNT_VALUE = 15000;

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory
     */
    protected function createFactory()
    {
        $builder = $this->getMockBuilder(ComputopApiBusinessFactory::class);
        $builder->setMethods(
            [
                'getComputopApiService',
                'getStore',
                'getConfig',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getComputopApiService')
            ->willReturn($this->createComputopApiService());
        $stub->method('getStore')
            ->willReturn($this->createStore());
        $stub->method('getConfig')
            ->willReturn($this->createConfig());

        return $stub;
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected function createConfig()
    {
        return new ComputopApiConfig();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\ComputopApi\Dependency\ComputopApiToStoreBridge
     */
    protected function createStore()
    {
        return $this->createMock(ComputopApiToStoreBridge::class);
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\ComputopApiService
     */
    protected function createComputopApiService()
    {
        $service = new ComputopApiService();
        $service->setFactory($this->createServiceFactory());

        return $service;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Service\ComputopApi\ComputopApiServiceFactory
     */
    protected function createServiceFactory()
    {
        $builder = $this->getMockBuilder(ComputopApiServiceFactory::class);
        $builder->setMethods(
            [
                'getConfig',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->createConfig());

        return $stub;
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected function createServiceConfig()
    {
        return new ComputopApiServiceConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function getQuoteTrasfer()
    {
        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setOrderReference(self::ORDER_REFERENCE_VALUE);

        return $quoteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer
     */
    protected function createComputopApiHeaderPaymentTransfer()
    {
        return (new ComputopApiHeaderPaymentTransfer())
            ->setTransId(self::TRANS_ID_VALUE)
            ->setPayId(self::PAY_ID_VALUE)
            ->setAmount(self::AMOUNT_VALUE);
    }
}
