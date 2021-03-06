<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Mapper;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Service\UtilText\Model\Hash;
use Spryker\Service\UtilText\UtilTextServiceInterface;
use SprykerEco\Service\ComputopApi\ComputopApiConfig;

class ComputopApiMapper implements ComputopApiMapperInterface
{
    protected const ITEMS_SEPARATOR = '|';
    protected const ATTRIBUTES_SEPARATOR = '-';
    protected const REQ_ID_LENGTH = 32;

    protected const GUEST_CUSTOMER_REFERENCE = 'guest-user-1';

    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $textService;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfig $config
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $textService
     */
    public function __construct(
        ComputopApiConfig $config,
        UtilTextServiceInterface $textService
    ) {
        $this->config = $config;
        $this->textService = $textService;
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiRequestTransfer $requestTransfer
     *
     * @return string
     */
    public function getPlaintextMac(ComputopApiRequestTransfer $requestTransfer): string
    {
        $macDataArray = [
            $requestTransfer->getPayId(),
            $requestTransfer->requireTransId()->getTransId(),
            $requestTransfer->requireMerchantId()->getMerchantId(),
            $requestTransfer->requireAmount()->getAmount(),
            $requestTransfer->requireCurrency()->getCurrency(),
        ];

        return implode($this->config->getMacSeparator(), $macDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header
     *
     * @return string
     */
    public function getMacResponseEncryptedValue(ComputopApiResponseHeaderTransfer $header): string
    {
        $macDataArray = [
            $header->requirePayId()->getPayId(),
            $header->requireTransId()->getTransId(),
            $header->requireMId()->getMId(),
            $header->requireStatus()->getStatus(),
            $header->requireCode()->getCode(),
        ];

        return implode($this->config->getMacSeparator(), $macDataArray);
    }

    /**
     * @param array $dataSubArray
     *
     * @return string
     */
    public function getDataPlainText(array $dataSubArray): string
    {
        $dataArray = [];
        foreach ($dataSubArray as $key => $value) {
            $dataArray[] = implode($this->config->getDataSubSeparator(), [$key, $value]);
        }

        return implode($this->config->getDataSeparator(), $dataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items): string
    {
        $description = '';

        foreach ($items as $item) {
            $description .= 'Name:' . $item->getName();
            $description .= static::ATTRIBUTES_SEPARATOR . 'Sku:' . $item->getSku();
            $description .= static::ATTRIBUTES_SEPARATOR . 'Quantity:' . $item->getQuantity();
            $description .= static::ITEMS_SEPARATOR;
        }

        return $description;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateReqIdFromQuoteTransfer(QuoteTransfer $quoteTransfer): string
    {
        return $this->generateReqId(
            $quoteTransfer->getTotals()->getHash(),
            $quoteTransfer->getCustomer()->getCustomerReference() ?? static::GUEST_CUSTOMER_REFERENCE
        );
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function generateReqIdFromOrderTransfer(OrderTransfer $orderTransfer): string
    {
        return $this->generateReqId(
            $orderTransfer->getTotals()->getHash(),
            $orderTransfer->getCustomer()->getCustomerReference() ?? static::GUEST_CUSTOMER_REFERENCE
        );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateTransId(QuoteTransfer $quoteTransfer): string
    {
        $parameters = [
            $this->createUniqueSalt(),
            $quoteTransfer->getCustomer()->getCustomerReference(),
        ];

        return $this->textService->hashValue(implode(static::ATTRIBUTES_SEPARATOR, $parameters), Hash::MD5);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param int $limit
     *
     * @return string
     */
    public function generateLimitedTransId(QuoteTransfer $quoteTransfer, int $limit): string
    {
        return substr($this->generateTransId($quoteTransfer), 0, $limit);
    }

    /**
     * @param string $hash
     * @param string $customerReference
     *
     * @return string
     */
    protected function generateReqId(string $hash, string $customerReference): string
    {
        $parameters = [
            $this->createUniqueSalt(),
            $hash,
            $customerReference,
        ];
        $string = $this->textService->hashValue(implode(static::ATTRIBUTES_SEPARATOR, $parameters), Hash::SHA256);

        return substr($string, 0, static::REQ_ID_LENGTH);
    }

    /**
     * @return string
     */
    protected function createUniqueSalt(): string
    {
        $params = [
            time(),
            rand(100, 1000),
        ];

        return implode(static::ATTRIBUTES_SEPARATOR, $params);
    }
}
