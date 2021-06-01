<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business;

use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface ComputopApiFacadeInterface
{
    /**
     * Specification:
     * - Perform EasyCredit status call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer
     */
    public function performEasyCreditStatusRequest(
        QuoteTransfer $quoteTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform EasyCredit Authorization call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer
     */
    public function performEasyCreditAuthorizeRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform Authorization call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer
     */
    public function performAuthorizationRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform Capture call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer
     */
    public function performCaptureRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform Inquire call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiInquireResponseTransfer
     */
    public function performInquireRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform Refund call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiRefundResponseTransfer
     */
    public function performRefundRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform Reverse call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
     *
     * @return \Generated\Shared\Transfer\ComputopApiReverseResponseTransfer
     */
    public function performReverseRequest(
        OrderTransfer $orderTransfer,
        ComputopApiHeaderPaymentTransfer $computopApiHeaderPayment
    );

    /**
     * Specification:
     * - Perform CRIF risk check call to Computop
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiCrifResponseTransfer
     */
    public function performCrifApiCall(QuoteTransfer $quoteTransfer);

    /**
     * Specification:
     * - Perform PayPal Express Prepare API call
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function performPayPalExpressPrepareApiCall(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * Specification:
     * - Perform PayPal Express Complete API call
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function performPayPalExpressCompleteApiCall(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
