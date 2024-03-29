<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi\Mapper;

use Generated\Shared\Transfer\ComputopApiRequestTransfer;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Service\UtilText\Model\Hash;
use SprykerEco\Service\ComputopApi\ComputopApiConfig;
use SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as SharedComputopApiConfig;

class ComputopApiMapper implements ComputopApiMapperInterface
{
    /**
     * @var string
     */
    protected const ITEMS_SEPARATOR = '|';

    /**
     * @var string
     */
    protected const ATTRIBUTES_SEPARATOR = '-';

    /**
     * @var int
     */
    protected const REQ_ID_LENGTH = 32;

    /**
     * @var string
     */
    protected const GUEST_CUSTOMER_REFERENCE = 'guest-user-1';

    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @var \SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface
     */
    protected $textService;

    /**
     * @var \SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface
     */
    protected $blowfishHasher;

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiConfig $config
     * @param \SprykerEco\Service\ComputopApi\Dependency\Service\ComputopApiToUtilTextServiceInterface $utilTextService
     * @param \SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface $blowfishHasher
     */
    public function __construct(
        ComputopApiConfig $config,
        ComputopApiToUtilTextServiceInterface $utilTextService,
        BlowfishHasherInterface $blowfishHasher
    ) {
        $this->config = $config;
        $this->textService = $utilTextService;
        $this->blowfishHasher = $blowfishHasher;
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
     * @param array $dataSubArray
     * @param string $password
     *
     * @return array<string, string|int>
     */
    public function getEncryptedArray(array $dataSubArray, string $password): array
    {
        $plainText = $this->getDataPlainText($dataSubArray);
        $length = mb_strlen($plainText);

        return [
            SharedComputopApiConfig::DATA => $this->blowfishHasher
                ->getBlowfishEncryptedValue($plainText, $length, $password),
            SharedComputopApiConfig::LENGTH => $length,
        ];
    }

    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $items
     *
     * @return string
     */
    public function getDescriptionValue(array $items): string
    {
        $descriptionParts = [];
        foreach ($items as $item) {
            $descriptionParts[] = $this->getItemDescription($item);
        }

        return implode(static::ITEMS_SEPARATOR, $descriptionParts);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function generateReqIdFromQuoteTransfer(QuoteTransfer $quoteTransfer): string
    {
        return $this->generateReqId(
            (string)$quoteTransfer->getTotalsOrFail()->getHash(),
            $quoteTransfer->getCustomerOrFail()->getCustomerReference() ?? static::GUEST_CUSTOMER_REFERENCE,
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
            (string)$orderTransfer->getTotalsOrFail()->getHash(),
            $orderTransfer->getCustomerOrFail()->getCustomerReference() ?? static::GUEST_CUSTOMER_REFERENCE,
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
            $quoteTransfer->getCustomerOrFail()->getCustomerReference() ?? uniqid('', true),
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

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    protected function getItemDescription(ItemTransfer $itemTransfer): string
    {
        return sprintf('Name:%s-Sku:%s-Quantity:%s', $itemTransfer->getName(), $itemTransfer->getSku(), $itemTransfer->getQuantity());
    }
}
