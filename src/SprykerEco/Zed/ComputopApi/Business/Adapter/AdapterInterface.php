<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Adapter;

interface AdapterInterface
{
    /**
     * @param array $data
     *
     * @return \GuzzleHttp\Psr7\Stream
     */
    public function sendRequest(array $data);
}
