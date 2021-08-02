<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi\Business\Converter;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\StreamInterface;
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig as ComputopApiSharedConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig as ComputopApiZedConfig;

class ConverterTestHelper extends Test
{
    public const AUTHORIZE_METHOD = 'AUTHORIZE';

    /**
     * @return \GuzzleHttp\Psr7\Stream
     */
    public function prepareResponse(): StreamInterface
    {
        return Psr7\stream_for('');
    }

    /**
     * @return \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    public function createComputopApiConfigMock()
    {
        return $this->createPartialMock(
            ComputopApiZedConfig::class,
            ['getBlowfishPass']
        );
    }

    /**
     * @return array
     */
    public function getMainDecryptedArray(): array
    {
        return [
            ComputopApiConfig::MERCHANT_ID_SHORT => 'mid',
            ComputopApiConfig::PAY_ID => 'PayID',
            ComputopApiConfig::X_ID => 'XID',
            ComputopApiConfig::TRANS_ID => 'TransID',
            ComputopApiConfig::STATUS => 'OK',
            ComputopApiConfig::CODE => '00000000',
            ComputopApiConfig::DESCRIPTION => 'Description',
        ];
    }

    /**
     * @param array $decryptedArray
     *
     * @return \SprykerEco\Service\ComputopApi\ComputopApiService
     */
    public function createComputopApiServiceMock(array $decryptedArray)
    {
        $computopServiceMock = $this->createPartialMock(
            ComputopApiService::class,
            ['decryptResponseHeader', 'extractResponseHeader', 'getResponseValue']
        );
        $computopServiceMock->method('decryptResponseHeader')
            ->willReturn($decryptedArray);

        $computopServiceMock->method('extractResponseHeader')
            ->willReturn($this->getHeaderResponseTransfer($decryptedArray));

        $computopServiceMock->method('getResponseValue')
            ->willReturnArgument(1);

        return $computopServiceMock;
    }

    /**
     * @param array $decryptedArray
     *
     * @return \Generated\Shared\Transfer\ComputopApiResponseHeaderTransfer
     */
    protected function getHeaderResponseTransfer(array $decryptedArray): ComputopApiResponseHeaderTransfer
    {
        $method = self::AUTHORIZE_METHOD;

        $header = new ComputopApiResponseHeaderTransfer();
        $header->fromArray($decryptedArray, true);

        // Different naming style
        $header->setMId($decryptedArray[ComputopApiConfig::MERCHANT_ID_SHORT]);
        $header->setTransId($decryptedArray[ComputopApiConfig::TRANS_ID]);
        $header->setPayId($decryptedArray[ComputopApiConfig::PAY_ID]);
        $header->setIsSuccess($header->getStatus() === ComputopApiSharedConfig::SUCCESS_STATUS);
        $header->setMethod($method);
        $header->setXId($decryptedArray[ComputopApiConfig::X_ID]);

        return $header;
    }
}
