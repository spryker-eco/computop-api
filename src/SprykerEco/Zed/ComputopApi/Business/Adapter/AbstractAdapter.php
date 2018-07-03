<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\StreamInterface;
use SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiHttpRequestException;
use SprykerEco\Zed\ComputopApi\ComputopApiConfig;

abstract class AbstractAdapter implements AdapterInterface
{
    protected const DEFAULT_TIMEOUT = 45;

    /**
     * @var \SprykerEco\Zed\ComputopApi\ComputopApiConfig
     */
    protected $config;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @return string
     */
    abstract protected function getUrl();

    /**
     * @param \SprykerEco\Zed\ComputopApi\ComputopApiConfig $config
     */
    public function __construct(ComputopApiConfig $config)
    {
        $this->client = new Client([
            RequestOptions::TIMEOUT => static::DEFAULT_TIMEOUT,
        ]);

        $this->config = $config;
    }

    /**
     * @param array $data
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sendRequest(array $data): StreamInterface
    {
        $options[RequestOptions::FORM_PARAMS] = $data;

        return $this->send($options);
    }

    /**
     * @param array $options
     *
     * @throws \SprykerEco\Zed\ComputopApi\Business\Exception\ComputopApiHttpRequestException
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function send(array $options = []): StreamInterface
    {
        try {
            $response = $this->client->post(
                $this->getUrl(),
                $options
            );
        } catch (RequestException $requestException) {
            throw new ComputopApiHttpRequestException(
                $requestException->getMessage(),
                $requestException->getCode(),
                $requestException
            );
        }

        return $response->getBody();
    }
}
