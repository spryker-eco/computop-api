<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper;

use SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;

interface ComputopApiBusinessMapperFactoryInterface
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeCreditCardMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReverseCreditCardMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquireCreditCardMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureCreditCardMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundCreditCardMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizePayNowMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayNowMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePayNowMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayNowMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayNowMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizePayPalMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayPalMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayPalExpressMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePayPalMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayPalMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayPalExpressMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayPalMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayPalExpressMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReverseDirectDebitMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquireDirectDebitMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureDirectDebitMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundDirectDebitMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundSofortMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePaydirektMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePaydirektMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePaydirektMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPaydirektMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeEasyCreditMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureEasyCreditMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundEasyCreditMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureIdealMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundIdealMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface
     */
    public function createStatusEasyCreditMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;
     */
    public function createCrifMapper();

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
     */
    public function createInquirePayuCeeSingleMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayuCeeSingleMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayuCeeSingleMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayuCeeSingleMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
     */
    public function createPayPalExpressPrepareMapper(): PayPalExpressMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\ExpressCheckout\PayPalExpressMapperInterface;
     */
    public function createPayPalExpressCompleteMapper(): PayPalExpressMapperInterface;
}
