<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopApi\Business;

use Generated\Shared\Transfer\ComputopApiAuthorizeResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCaptureResponseTransfer;
use Generated\Shared\Transfer\ComputopApiCrifResponseTransfer;
use Generated\Shared\Transfer\ComputopApiEasyCreditStatusResponseTransfer;
use Generated\Shared\Transfer\ComputopApiHeaderPaymentTransfer;
use Generated\Shared\Transfer\ComputopApiInquireResponseTransfer;
use Generated\Shared\Transfer\ComputopApiRefundResponseTransfer;
use Generated\Shared\Transfer\ComputopApiReverseResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\ComputopApi\Business\ComputopApiBusinessFactory getFactory()
 */
class ComputopApiFacade extends AbstractFacade implements ComputopApiFacadeInterface
{
    /**
     * {@inheritDoc}
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
    ): ComputopApiEasyCreditStatusResponseTransfer {
        return $this
            ->getFactory()
            ->createEasyCreditStatusRequest()
            ->request($quoteTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiAuthorizeResponseTransfer {
        return $this
            ->getFactory()
            ->createEasyCreditAuthorizeRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiAuthorizeResponseTransfer {
        return $this
            ->getFactory()
            ->createAuthorizationPaymentRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiCaptureResponseTransfer {
        return $this
            ->getFactory()
            ->createCapturePaymentRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiInquireResponseTransfer {
        return $this
            ->getFactory()
            ->createInquirePaymentRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiRefundResponseTransfer {
        return $this
            ->getFactory()
            ->createRefundPaymentRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
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
    ): ComputopApiReverseResponseTransfer {
        return $this
            ->getFactory()
            ->createReversePaymentRequest()
            ->request($orderTransfer, $computopApiHeaderPayment);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ComputopApiCrifResponseTransfer
     */
    public function performCrifApiCall(QuoteTransfer $quoteTransfer): ComputopApiCrifResponseTransfer
    {
        return $this
            ->getFactory()
            ->createCrifRequest()
            ->request($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function performPayPalExpressPrepareApiCall(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this
           ->getFactory()
           ->createPayPalExpressPrepareRequest()
           ->sendRequest($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function performPayPalExpressCompleteApiCall(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this
            ->getFactory()
            ->createPayPalExpressCompleteRequest()
            ->sendRequest($quoteTransfer);
    }
}
