<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Mapper\CreditCard;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Service\ComputopApi\ComputopApiServiceFactory;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ComputopApiSharedConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeBridge;

class CreditCardMapperTestHelper extends Test
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    public function createOrderTransferMock()
    {
        $orderTransferMock = $this->createPartialMock(
            OrderTransfer::class,
            ['getIdSalesOrder', 'getTotals', 'getItems'],
        );

        $totalsTransferMock = $this->createPartialMock(
            TotalsTransfer::class,
            ['getGrandTotal'],
        );

        $totalsTransferMock->method('getGrandTotal')
            ->willReturn('100');

        $orderTransferMock->method('getTotals')
            ->willReturn($totalsTransferMock);

        $itemsTransferMock = $this->createPartialMock(
            ItemTransfer::class,
            ['getArrayCopy'],
        );

        $itemsTransferMock->method('getArrayCopy')
            ->willReturn([]);

        $orderTransferMock->method('getItems')
            ->willReturn($itemsTransferMock);

        return $orderTransferMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    public function createComputopApiConfigMock()
    {
        $configMock = $this->createPartialMock(
            ComputopApiConfig::class,
            ['getBlowfishPass'],
        );

        return $configMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Service\ComputopApi\ComputopApiService
     */
    public function createComputopApiServiceMock()
    {
        $encryptedArray = [
            ComputopApiSharedConfig::LENGTH => CreditCardMapperTestConstants::LENGTH_VALUE,
            ComputopApiSharedConfig::DATA => CreditCardMapperTestConstants::DATA_VALUE,
        ];

        $computopServiceMock = $this->createPartialMock(
            ComputopApiService::class,
            [
                'getMacEncryptedValue',
                'getEncryptedArray',
                'getDescriptionValue',
                'getTestModeDescriptionValue',
                'generateReqIdFromOrderTransfer',
                'generateTransId',
                'getFactory',
            ],
        );

        $computopServiceMock->method('getEncryptedArray')
            ->willReturn($encryptedArray);

        $computopServiceMock->method('getDescriptionValue')
            ->willReturn('');

        $computopServiceMock->method('getTestModeDescriptionValue')
            ->willReturn('');

        $computopServiceMock->method('generateReqIdFromOrderTransfer')
            ->willReturn('');

        $computopServiceMock->method('generateTransId')
            ->willReturn('');

        $computopServiceMock->method('getFactory')
            ->willReturn(new ComputopApiServiceFactory());

        return $computopServiceMock;
    }

    /**
     * @param string $payId
     * @param string $transId
     *
     * @return \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer
     */
    public function createComputopApiHeaderPaymentTransfer($payId = '', $transId = '')
    {
        $headerPayment = new ComputopApiHeaderPaymentTransfer();
        $headerPayment->setAmount(100);
        $headerPayment->setPayId($payId);
        $headerPayment->setTransId($transId);

        return $headerPayment;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\Dependency\Facade\ComputopApiToStoreFacadeInterface
     */
    public function createStoreMock()
    {
        $store = (new StoreTransfer())
            ->setSelectedCurrencyIsoCode('EUR');

        $storeMock = $this->createPartialMock(
            ComputopApiToStoreFacadeBridge::class,
            ['getCurrentStore'],
        );

        $storeMock->method('getCurrentStore')
            ->willReturn($store);

        return $storeMock;
    }
}
