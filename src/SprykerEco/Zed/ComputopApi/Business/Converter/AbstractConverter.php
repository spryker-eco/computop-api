<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractConverter implements ConverterInterface
{
    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected $computopApiService;

    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @param array $decryptedResponse
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     *
     * @codingStandardsIgnoreStart
     */
    abstract protected function getResponseTransfer(array $decryptedResponse);

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopApiService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     */
    public function __construct(ComputopApiServiceInterface $computopApiService, ComputopApiConfig $config)
    {
        $this->computopApiService = $computopApiService;
        $this->config = $config;
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(StreamInterface $response): TransferInterface
    {
        $decryptedResponse = $this->decryptResponse($response);

        return $this->getResponseTransfer($decryptedResponse);
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return array
     */
    protected function decryptResponse(StreamInterface $response): array
    {
        parse_str($response->getContents(), $responseHeader);

        $decryptedResponseHeader = $this
            ->computopApiService
            ->decryptResponseHeader($responseHeader, $this->config->getBlowfishPass());

        return $decryptedResponseHeader;
    }
}
