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
    protected const AUTHORIZE_METHOD = 'AUTHORIZE';
    protected const CAPTURE_METHOD = 'CAPTURE';
    protected const REVERSE_METHOD = 'REVERSE';
    protected const INQUIRE_METHOD = 'INQUIRE';
    protected const REFUND_METHOD = 'REFUND';

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->get(ComputopApiConstants::MERCHANT_ID);
    }

    /**
     * @return string
     */
    public function getBlowfishPass(): string
    {
        return $this->get(ComputopApiConstants::BLOWFISH_PASSWORD);
    }

    /**
     * @return string
     */
    public function getAuthorizeAction(): string
    {
        return $this->get(ComputopApiConstants::AUTHORIZE_ACTION);
    }

    /**
     * @return string
     */
    public function getCaptureAction(): string
    {
        return $this->get(ComputopApiConstants::CAPTURE_ACTION);
    }

    /**
     * @return string
     */
    public function getRefundAction(): string
    {
        return $this->get(ComputopApiConstants::REFUND_ACTION);
    }

    /**
     * @return string
     */
    public function getInquireAction(): string
    {
        return $this->get(ComputopApiConstants::INQUIRE_ACTION);
    }

    /**
     * @return string
     */
    public function getReverseAction(): string
    {
        return $this->get(ComputopApiConstants::REVERSE_ACTION);
    }

    /**
     * @return string
     */
    public function getEasyCreditStatusUrl(): string
    {
        return $this->get(ComputopApiConstants::EASY_CREDIT_STATUS_ACTION);
    }

    /**
     * @return string
     */
    public function getEasyCreditAuthorizeUrl(): string
    {
        return $this->get(ComputopApiConstants::EASY_CREDIT_AUTHORIZE_ACTION);
    }

    /**
     * @return string
     */
    public function getCrifActionUrl(): string
    {
        return $this->get(ComputopApiConstants::CRIF_ACTION);
    }

    /**
     * @return string
     */
    public function getAuthorizeMethodName(): string
    {
        return static::AUTHORIZE_METHOD;
    }

    /**
     * @return string
     */
    public function getCaptureMethodName(): string
    {
        return static::CAPTURE_METHOD;
    }

    /**
     * @return string
     */
    public function getRefundMethodName(): string
    {
        return static::REFUND_METHOD;
    }

    /**
     * @return string
     */
    public function getReverseMethodName(): string
    {
        return static::REVERSE_METHOD;
    }

    /**
     * @return string
     */
    public function getInquireMethodName(): string
    {
        return static::INQUIRE_METHOD;
    }

    /**
     * @return string[]
     */
    public function getPaymentMethodsCaptureTypes(): array
    {
        return $this->get(ComputopApiConstants::PAYMENT_METHODS_CAPTURE_TYPES);
    }

    /**
     * @return string
     */
    public function getCrifProductName(): string
    {
        return $this->get(ComputopApiConstants::CRIF_PRODUCT_NAME);
    }

    /**
     * @return string
     */
    public function getCrifLegalForm(): string
    {
        return $this->get(ComputopApiConstants::CRIF_LEGAL_FORM);
    }
}
