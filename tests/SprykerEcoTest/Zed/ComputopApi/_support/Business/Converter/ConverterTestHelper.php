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
use SprykerEco\Service\ComputopApi\ComputopApiService;
use SprykerEco\Shared\ComputopApi\ComputopApiConfig as ComputopApiSharedConfig;
use SprykerEco\Shared\ComputopApi\Config\ComputopApiConfig;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig as ComputopApiZedConfig;

class ConverterTestHelper extends Test
{
    /**
     * @var string
     */
    public const AUTHORIZE_METHOD = 'AUTHORIZE';

    /**
     * @return \GuzzleHttp\Psr7\Stream
     */
    public function prepareResponse()
    {
        $expectedResponse = '';
        $stream = Psr7\stream_for($expectedResponse);

        return $stream;
    }

    /**
     * @param string $expectedResponseBody
    /**
     *
     * @return \GuzzleHttp\Psr7\Stream
     */
    public function prepareUnencryptedResponse(string $expectedResponseBody): Stream
    {
        $stream = Psr7\stream_for($expectedResponseBody);

        return $stream;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    public function createComputopApiConfigMock()
    {
        $configMock = $this->createPartialMock(
            ComputopApiZedConfig::class,
            ['getBlowfishPass']
        );

        return $configMock;
    }

    /**
     * @return array
     */
    public function getMainDecryptedArray()
    {
        $decryptedArray = [
            ComputopApiConfig::MERCHANT_ID_SHORT => 'mid',
            ComputopApiConfig::PAY_ID => 'PayID',
            ComputopApiConfig::X_ID => 'XID',
            ComputopApiConfig::TRANS_ID => 'TransID',
            ComputopApiConfig::STATUS => 'OK',
            ComputopApiConfig::CODE => '00000000',
            ComputopApiConfig::DESCRIPTION => 'Description',
        ];

        return $decryptedArray;
    }

    /**
     * @param array $decryptedArray
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Service\ComputopApi\ComputopApiService
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
    protected function getHeaderResponseTransfer(array $decryptedArray)
    {
        $method = self::AUTHORIZE_METHOD;

        $header = new ComputopApiResponseHeaderTransfer();
        $header->fromArray($decryptedArray, true);

        //different naming style
        $header->setMId($decryptedArray[ComputopApiConfig::MERCHANT_ID_SHORT]);
        $header->setTransId($decryptedArray[ComputopApiConfig::TRANS_ID]);
        $header->setPayId($decryptedArray[ComputopApiConfig::PAY_ID]);
        $header->setIsSuccess($header->getStatus() === ComputopApiSharedConfig::SUCCESS_STATUS);
        $header->setMethod($method);
        $header->setXId($decryptedArray[ComputopApiConfig::X_ID]);

        return $header;
    }
}
