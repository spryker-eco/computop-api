<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\PostPlace;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiMethodMapperException;
use SprykerEco\Zed\ComputopApi\Business\Exception\PaymentMethodNotSetException;
use SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;

abstract class AbstractPaymentRequest implements PostPlaceRequestInterface
{
    /**
     * @var \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * @var \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface
     */
    protected $converter;

    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var \SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface[]
     */
    protected $methodMappers = [];

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface $adapter
     * @param \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface $converter
     */
    public function __construct(
        AdapterInterface $adapter,
        ConverterInterface $converter
    ) {
        $this->adapter = $adapter;
        $this->converter = $converter;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function request(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    ): TransferInterface {
        $requestData = $this
            ->getMethodMapper($this->getPaymentMethodFromOrder($orderTransfer))
            ->buildRequest($orderTransfer, $computopApiHeaderPayment);

        return $this->sendRequest($requestData);
    }

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface $paymentMethod
     *
     * @return void
     */
    public function registerMapper(PostPlaceMapperInterface $paymentMethod): void
    {
        $this->methodMappers[$paymentMethod->getMethodName()] = $paymentMethod;
    }

    /**
     * @param array $requestData
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function sendRequest(array $requestData): TransferInterface
    {
        $response = $this->adapter->sendRequest($requestData);

        return $this->converter->toTransactionResponseTransfer($response);
    }

    /**
     * @param string $methodName
     *
     * @throws \SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiMethodMapperException
     *
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface
     */
    protected function getMethodMapper($methodName): MapperInterface
    {
        if (isset($this->methodMappers[$methodName]) === false) {
            throw new ComputopApiMethodMapperException('The method mapper is not registered.');
        }

        return $this->methodMappers[$methodName];
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @throws \SprykerEco\Zed\ComputopApi\Business\Exception\PaymentMethodNotSetException
     *
     * @return string
     */
    protected function getPaymentMethodFromOrder(OrderTransfer $orderTransfer): string
    {
        $paymentsArray = $orderTransfer->getPayments()->getArrayCopy();

        if (!$paymentsArray) {
            throw new PaymentMethodNotSetException('The payment is not set.');
        }

        return $this->getPaymentMethodFromPayment(array_shift($paymentsArray));
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return string
     */
    protected function getPaymentMethodFromPayment(PaymentTransfer $paymentTransfer): string
    {
        return $paymentTransfer->getPaymentMethod();
    }
}
