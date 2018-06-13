<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Model\Mapper;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Service\UtilText\Model\Hash;
use Spryker\Service\UtilText\UtilTextServiceInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Service\ComputopApi\ComputopApiConfigInterface;
use SprykerEco\Service\ComputopApi\Model\AbstractComputopApi;

class ComputopApiMapper extends AbstractComputopApi implements ComputopApiMapperInterface
{
    const ITEMS_SEPARATOR = '|';
    const ATTRIBUTES_SEPARATOR = '-';
    const REQ_ID_LENGTH = 32;

    const ORDER_DESC_SUCCESS = 'Test:0000';
    const ORDER_DESC_ERROR = 'Test:0305';

    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $textService;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfigInterface $config
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $textService
     */
    public function __construct(
        ComputopApiConfigInterface $config,
        UtilTextServiceInterface $textService
    ) {
        parent::__construct($config);

        $this->textService = $textService;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $cardPaymentTransfer
     *
     * @return string
     */
    public function getMacEncryptedValue(TransferInterface $cardPaymentTransfer)
    {
        $macDataArray = [
            $cardPaymentTransfer->getPayId(),
            $cardPaymentTransfer->requireTransId()->getTransId(),
            $cardPaymentTransfer->requireMerchantId()->getMerchantId(),
            $cardPaymentTransfer->requireAmount()->getAmount(),
            $cardPaymentTransfer->requireCurrency()->getCurrency(),
        ];

        return implode(self::MAC_SEPARATOR, $macDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header
     *
     * @return string
     */
    public function getMacResponseEncryptedValue(ComputopApiResponseHeaderTransfer $header)
    {
        $macDataArray = [
            $header->requirePayId()->getPayId(),
            $header->requireTransId()->getTransId(),
            $header->requireMId()->getMId(),
            $header->requireStatus()->getStatus(),
            $header->requireCode()->getCode(),
        ];

        return implode(self::MAC_SEPARATOR, $macDataArray);
    }

    /**
     * @param array $dataSubArray
     *
     * @return string
     */
    public function getDataPlainText(array $dataSubArray)
    {
        $dataArray = [];
        foreach ($dataSubArray as $key => $value) {
            $dataArray[] = implode(self::DATA_SUB_SEPARATOR, [$key, $value]);
        }

        return implode(self::DATA_SEPARATOR, $dataArray);
    }

    /**
     * @param array $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items)
    {
        $description = '';

        foreach ($items as $item) {
            $description .= 'Name:' . $item->getName();
            $description .= self::ATTRIBUTES_SEPARATOR . 'Sku:' . $item->getSku();
            $description .= self::ATTRIBUTES_SEPARATOR . 'Quantity:' . $item->getQuantity();
            $description .= self::ITEMS_SEPARATOR;
        }

        return $description;
    }

    /**
     * @param array $items
     *
     * @return string
     */
    public function getTestModeDescriptionValue(array $items)
    {
        $description = '';

        if ($this->config->isTestMode()) {
            $description = self::ORDER_DESC_SUCCESS;
            $description .= self::ITEMS_SEPARATOR;
        }

        $description .= $this->getDescriptionValue($items);

        return $description;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer|\Generated\Shared\Transfer\QuoteTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     *
     * @return string
     */
    public function generateReqId(TransferInterface $transfer)
    {
        $parameters = [
            $this->createUniqueSalt(),
            $transfer->getTotals()->getHash(),
            $transfer->getCustomer()->getCustomerReference(),
        ];
        $string = $this->textService->hashValue(implode(self::ATTRIBUTES_SEPARATOR, $parameters), Hash::SHA256);

        return substr($string, 0, self::REQ_ID_LENGTH);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateTransId(QuoteTransfer $quoteTransfer)
    {
        $parameters = [
            $this->createUniqueSalt(),
            $quoteTransfer->getCustomer()->getCustomerReference(),
        ];

        return $this->textService->hashValue(implode(self::ATTRIBUTES_SEPARATOR, $parameters), Hash::MD5);
    }

    /**
     * @return string
     */
    protected function createUniqueSalt()
    {
        $params = [
            time(),
            rand(100, 1000),
        ];

        return implode(self::ATTRIBUTES_SEPARATOR, $params);
    }
}
