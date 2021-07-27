<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business\Mapper;

use SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface;
use SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;

interface ComputopApiBusinessMapperFactoryInterface
{
    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeCreditCardMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReverseCreditCardMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquireCreditCardMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureCreditCardMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundCreditCardMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizePayNowMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayNowMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePayNowMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayNowMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayNowMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizePayPalMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePayPalMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePayPalMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePayPalMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPayPalMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReverseDirectDebitMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquireDirectDebitMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureDirectDebitMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundDirectDebitMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundSofortMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createReversePaydirektMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createInquirePaydirektMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCapturePaydirektMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundPaydirektMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createAuthorizeEasyCreditMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureEasyCreditMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundEasyCreditMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createCaptureIdealMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PostPlace\PostPlaceMapperInterface
     */
    public function createRefundIdealMapper(): PostPlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\PrePlace\PrePlaceMapperInterface
     */
    public function createStatusEasyCreditMapper(): PrePlaceMapperInterface;

    /**
     * @return \SprykerEco\Zed\ComputopApi\Business\Mapper\RiskCheck\ApiRiskCheckMapperInterface;
     */
    public function createCrifMapper(): ApiRiskCheckMapperInterface;

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
}
