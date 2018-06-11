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
     * Test mode enabled
     * It changes description for API calls
     */
    const COMPUTOP_TEST_MODE_ENABLED = true;

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

    /**
     * @return bool
     */
    public function isTestMode()
    {
        return self::COMPUTOP_TEST_MODE_ENABLED;
    }
}
