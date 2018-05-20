<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Service\ComputopApi;

use Spryker\Service\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\ComputopApi\ComputopApiConstants;

class ComputopApiConfig extends AbstractBundleConfig implements ComputopApiConfigInterface
{
    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMacRequired($method)
    {
        return in_array($method, (array)$this->get(ComputopApiConstants::RESPONSE_MAC_REQUIRED, []));
    }

    /**
     * @return string
     */
    public function getHmacPassword()
    {
        return $this->get(ComputopApiConstants::HMAC_PASSWORD);
    }
}
