<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Request\PrePlace;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;

abstract class AbstractPaymentRequest implements PrePlaceRequestInterface
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
     * @var \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface
     */
    protected $mapper;

    /**
     * @param \SprykerEco\Zed\ComputopApi\Business\Adapter\AdapterInterface $adapter
     * @param \SprykerEco\Zed\ComputopApi\Business\Converter\ConverterInterface $converter
     * @param \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface $mapper
     */
    public function __construct(
        AdapterInterface $adapter,
        ConverterInterface $converter,
        PrePlaceMapperInterface $mapper
    ) {
        $this->adapter = $adapter;
        $this->converter = $converter;
        $this->mapper = $mapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function request(QuoteTransfer $quoteTransfer, ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment)
    {
        $requestData = $this
            ->mapper
            ->buildRequest($quoteTransfer, $computopApiHeaderPayment);

        return $this->sendRequest($requestData);
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
}
