<?php

namespace SprykerEco\Zed\ComputopApi\Business\Request\ExpressCheckout;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;

abstract class AbstractPayPalExpressRequest
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @var PayPalExpressMapperInterface
     */
    protected $mapper;

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface $adapter
     * @param \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface $converter
     * @param \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface $mapper
     */
    public function __construct(
        AdapterInterface $adapter,
        ConverterInterface $converter,
        PayPalExpressMapperInterface $mapper
    )
    {
        $this->adapter = $adapter;
        $this->converter = $converter;
        $this->mapper = $mapper;
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
}
