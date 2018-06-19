<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\ComputopApi\ComputopApiConstants;

class ComputopApiConfig extends AbstractBundleConfig
{
    const ETI_ID = '0.0.1';

    const AUTHORIZE_METHOD = 'AUTHORIZE';
    const CAPTURE_METHOD = 'CAPTURE';
    const REVERSE_METHOD = 'REVERSE';
    const INQUIRE_METHOD = 'INQUIRE';
    const REFUND_METHOD = 'REFUND';

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->get(ComputopApiConstants::MERCHANT_ID);
    }

    /**
     * @return string
     */
    public function getBlowfishPass()
    {
        return $this->get(ComputopApiConstants::BLOWFISH_PASSWORD);
    }

    /**
     * @return string
     */
    public function getAuthorizeAction()
    {
        return $this->get(ComputopApiConstants::AUTHORIZE_ACTION);
    }

    /**
     * @return string
     */
    public function getCaptureAction()
    {
        return $this->get(ComputopApiConstants::CAPTURE_ACTION);
    }

    /**
     * @return string
     */
    public function getRefundAction()
    {
        return $this->get(ComputopApiConstants::REFUND_ACTION);
    }

    /**
     * @return string
     */
    public function getInquireAction()
    {
        return $this->get(ComputopApiConstants::INQUIRE_ACTION);
    }

    /**
     * @return string
     */
    public function getReverseAction()
    {
        return $this->get(ComputopApiConstants::REVERSE_ACTION);
    }

    /**
     * @return string
     */
    public function getEasyCreditStatusUrl()
    {
        return $this->get(ComputopApiConstants::EASY_CREDIT_STATUS_ACTION);
    }

    /**
     * @return string
     */
    public function getEasyCreditAuthorizeUrl()
    {
        return $this->get(ComputopApiConstants::EASY_CREDIT_AUTHORIZE_ACTION);
    }

    /**
     * @return string
     */
    public function getAuthorizeMethodName()
    {
        return self::AUTHORIZE_METHOD;
    }

    /**
     * @return string
     */
    public function getCaptureMethodName()
    {
        return self::CAPTURE_METHOD;
    }

    /**
     * @return string
     */
    public function getRefundMethodName()
    {
        return self::REFUND_METHOD;
    }

    /**
     * @return string
     */
    public function getReverseMethodName()
    {
        return self::REVERSE_METHOD;
    }

    /**
     * @return string
     */
    public function getInquireMethodName()
    {
        return self::INQUIRE_METHOD;
    }
}
