<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Converter;

use GuzzleHttp\Psr7\Stream;
use SprykerEco\Service\ComputopApi\ComputopApiServiceInterface;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractConverter implements ConverterInterface
{
    /**
     * @var \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface
     */
    protected $computopService;

    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @param array $decryptedArray
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    abstract protected function getResponseTransfer(array $decryptedArray);

    /**
     * @param \SprykerEco\Service\ComputopApi\ComputopApiServiceInterface $computopService
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     */
    public function __construct(ComputopApiServiceInterface $computopService, ComputopApiConfig $config)
    {
        $this->computopService = $computopService;
        $this->config = $config;
    }

    /**
     * @param \GuzzleHttp\Psr7\Stream $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(Stream $response)
    {
        $decryptedArray = $this->getDecryptedArray($response);

        return $this->getResponseTransfer($decryptedArray);
    }

    /**
     * @param \GuzzleHttp\Psr7\Stream $response
     *
     * @return array
     */
    protected function getDecryptedArray(Stream $response)
    {
        parse_str($response->getContents(), $responseArray);

        $decryptedArray = $this
            ->computopService
            ->getDecryptedArray($responseArray, $this->config->getBlowfishPass());

        return $decryptedArray;
    }
}
