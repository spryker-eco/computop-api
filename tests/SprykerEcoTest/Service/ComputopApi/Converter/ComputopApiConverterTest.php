<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi\Converter;

use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use SprykerEco\Service\ComputopApi\Exception\ComputopApiConverterException;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig as ApiConfig;
use SprykerEcoTest\Service\ComputopApi\AbstractComputopApiTest;

/**
 * @group Unit
 * @group SprykerEco
 * @group Service
 * @group ComputopApi
 * @group Api
 * @group Converter
 * @group ComputopApiConverterTest
 */
class ComputopApiConverterTest extends AbstractComputopApiTest
{
    /**
     * @var string
     */
    public const METHOD = 'AUTHORIZE';

    /**
     * @var string
     */
    public const PAY_ID_VALUE = 'PAY_ID_VALUE';

    /**
     * @var string
     */
    public const TRANS_ID_VALUE = 'TRANS_ID_VALUE';

    /**
     * @var string
     */
    public const MERCHANT_ID_VALUE = 'MERCHANT_ID_VALUE';

    /**
     * @var string
     */
    public const X_ID_VALUE = 'X_ID_VALUE';

    /**
     * @var string
     */
    public const CODE_VALUE = '0';

    /**
     * @var string
     */
    public const STATUS_ERROR_VALUE = 'STATUS_ERROR_VALUE';

    /**
     * @var string
     */
    public const FAILED_CODE = '2150050';

    /**
     * @return void
     */
    public function testExtractIsSuccessHeader()
    {
        $converter = $this->helper->createConverter();
        $decryptedArray = $this->getDecryptedArray(ComputopApiConfig::SUCCESS_STATUS);

        /** @var \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header */
        $header = $converter->extractResponseHeader($decryptedArray, static::METHOD);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $header);
        $this->assertTrue($header->getIsSuccess());

        $this->assertSame(ApiConfig::MERCHANT_ID_SHORT, $header->getMId());
        $this->assertSame(ApiConfig::TRANS_ID, $header->getTransId());
        $this->assertSame(ApiConfig::PAY_ID, $header->getPayId());
        $this->assertSame(ComputopApiConfig::SUCCESS_STATUS, $header->getStatus());
        $this->assertSame(static::CODE_VALUE, $header->getCode());
        $this->assertSame(ApiConfig::X_ID, $header->getXId());
    }

    /**
     * @return void
     */
    public function testExtractIsErrorHeader()
    {
        $converter = $this->helper->createConverter();
        $decryptedArray = $this->getDecryptedArray(static::STATUS_ERROR_VALUE);
        $decryptedArray[ApiConfig::CODE] = static::FAILED_CODE;

        /** @var \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header */
        $header = $converter->extractResponseHeader($decryptedArray, static::METHOD);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $header);
        $this->assertFalse($header->getIsSuccess());

        $this->assertSame(ApiConfig::MERCHANT_ID_SHORT, $header->getMId());
        $this->assertSame(ApiConfig::TRANS_ID, $header->getTransId());
        $this->assertSame(ApiConfig::PAY_ID, $header->getPayId());
        $this->assertSame(static::STATUS_ERROR_VALUE, $header->getStatus());
        $this->assertSame(static::FAILED_CODE, $header->getCode());
        $this->assertSame(ApiConfig::X_ID, $header->getXId());
    }

    /**
     * @return void
     */
    public function testCheckEncryptedResponse()
    {
        $converter = $this->helper->createConverter();

        $responseArray = [
            ApiConfig::DATA => 'data',
            ApiConfig::LENGTH => 4,
        ];

        $converter->checkEncryptedResponse($responseArray);
    }

    /**
     * @return void
     */
    public function testCheckEncryptedResponseError()
    {
        $this->expectException(ComputopApiConverterException::class);

        $converter = $this->helper->createConverter();
        $converter->checkEncryptedResponse([]);
    }

    /**
     * @param string $status
     *
     * @return array
     */
    protected function getDecryptedArray($status)
    {
        $decryptedArray = [
            ApiConfig::MERCHANT_ID_SHORT => ApiConfig::MERCHANT_ID_SHORT,
            ApiConfig::TRANS_ID => ApiConfig::TRANS_ID,
            ApiConfig::PAY_ID => ApiConfig::PAY_ID,
            ApiConfig::STATUS => $status,
            ApiConfig::CODE => static::CODE_VALUE,
            ApiConfig::X_ID => ApiConfig::X_ID,
        ];

        return $decryptedArray;
    }
}
