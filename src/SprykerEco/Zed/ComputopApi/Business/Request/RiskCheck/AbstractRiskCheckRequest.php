<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\RiskCheck;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;

abstract class AbstractRiskCheckRequest implements RiskCheckRequestInterface
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
     * @var \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface
     */
    protected $mapper;

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface $adapter
     * @param \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface $converter
     * @param \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface $mapper
     */
    public function __construct(
        AdapterInterface $adapter,
        ConverterInterface $converter,
        ApiRiskCheckMapperInterface $mapper
    ) {
        $this->adapter = $adapter;
        $this->converter = $converter;
        $this->mapper = $mapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function request(QuoteTransfer $quoteTransfer): TransferInterface
    {
        $requestData = $this->mapper->buildRequest($quoteTransfer);

        return $this->sendRequest($requestData);
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
