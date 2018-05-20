<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\PostPlace;

use Generated\Shared\Transfer\ComputopHeaderPaymentTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiMethodMapperException;
use SprykerEco\Zed\ComputopApi\Business\Exception\PaymentMethodNotSetException;

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
     * @param \Generated\Shared\Transfer\ComputopHeaderPaymentTransfer $computopHeaderPayment
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function request(OrderTransfer $orderTransfer, ComputopHeaderPaymentTransfer $computopHeaderPayment)
    {
        $requestData = $this
            ->getMethodMapper($this->getPaymentMethodFromOrder($orderTransfer))
            ->buildRequest($orderTransfer, $computopHeaderPayment);

        return $this->sendRequest($requestData);
    }

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface $paymentMethod
     *
     * @return void
     */
    public function registerMapper(PostPlaceMapperInterface $paymentMethod)
    {
        $this->methodMappers[$paymentMethod->getMethodName()] = $paymentMethod;
    }

    /**
     * @param array $requestData
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function sendRequest(array $requestData)
    {
        $requestData = $this
            ->adapter
            ->sendRequest($requestData);

        $responseTransfer = $this
            ->converter
            ->toTransactionResponseTransfer(
                $requestData
            );

        return $responseTransfer;
    }

    /**
     * @param string $methodName
     *
     * @throws \SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiMethodMapperException
     *
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\MapperInterface
     */
    protected function getMethodMapper($methodName)
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
    protected function getPaymentMethodFromOrder(OrderTransfer $orderTransfer)
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
    protected function getPaymentMethodFromPayment(PaymentTransfer $paymentTransfer)
    {
        return $paymentTransfer->getPaymentMethod();
    }
}
