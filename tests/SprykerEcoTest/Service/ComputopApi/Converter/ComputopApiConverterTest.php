<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\Computop\Converter;

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
    const METHOD = 'AUTHORIZE';

    const PAY_ID_VALUE = 'PAY_ID_VALUE';
    const TRANS_ID_VALUE = 'TRANS_ID_VALUE';
    const MERCHANT_ID_VALUE = 'MERCHANT_ID_VALUE';
    const X_ID_VALUE = 'X_ID_VALUE';
    const CODE_VALUE = 'CODE_VALUE';
    const STATUS_ERROR_VALUE = 'STATUS_ERROR_VALUE';

    /**
     * @return void
     */
    public function testExtractIsSuccessHeader()
    {
        $converter = $this->helper->createConverter();
        $decryptedArray = $this->getDecryptedArray(ComputopApiConfig::SUCCESS_STATUS);

        /** @var \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header */
        $header = $converter->extractHeader($decryptedArray, self::METHOD);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $header);
        $this->assertTrue($header->getIsSuccess());

        //todo:update test
        $this->assertSame(ApiConfig::MERCHANT_ID_SHORT, $header->getMId());
        $this->assertSame(ApiConfig::TRANS_ID, $header->getTransId());
        $this->assertSame(ApiConfig::PAY_ID, $header->getPayId());
        $this->assertSame(ComputopApiConfig::SUCCESS_STATUS, $header->getStatus());
        $this->assertSame(ApiConfig::CODE, $header->getCode());
        $this->assertSame(ApiConfig::X_ID, $header->getXId());
    }

    /**
     * @return void
     */
    public function testExtractIsErrorHeader()
    {
        $converter = $this->helper->createConverter();
        $decryptedArray = $this->getDecryptedArray(self::STATUS_ERROR_VALUE);

        /** @var \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer $header */
        $header = $converter->extractHeader($decryptedArray, self::METHOD);

        $this->assertInstanceOf(ComputopApiResponseHeaderTransfer::class, $header);
        $this->assertFalse($header->getIsSuccess());

        $this->assertSame(ApiConfig::MERCHANT_ID_SHORT, $header->getMId());
        $this->assertSame(ApiConfig::TRANS_ID, $header->getTransId());
        $this->assertSame(ApiConfig::PAY_ID, $header->getPayId());
        $this->assertSame(self::STATUS_ERROR_VALUE, $header->getStatus());
        $this->assertSame(ApiConfig::CODE, $header->getCode());
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
            ApiConfig::CODE => ApiConfig::CODE,
            ApiConfig::X_ID => ApiConfig::X_ID,
        ];

        return $decryptedArray;
    }
}
