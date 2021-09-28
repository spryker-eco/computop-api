<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi;

use Codeception\Actor;
use Codeception\Scenario;
use Generated\Shared\Transfer\ComputopApiPayPalExpressPrepareResponseTransfer;
use Generated\Shared\Transfer\ComputopPayPalExpressPaymentTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class ComputopApiZedTester extends Actor
{
    use _generated\ComputopApiZedTesterActions;

    /**
     * @var string
     */
    protected const DATA_VALUE = 'Data';
    /**
     * @var int
     */
    protected const LENGTH_VALUE = 10;

    /**
     * @param \Codeception\Scenario $scenario
     */
    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);
        $this->setUpConfig();
    }

    /**
     * Set up config
     *
     * @return void
     */
    public function setUpConfig()
    {
        $this->setConfig('COMPUTOPAPI:MERCHANT_ID', 'COMPUTOPAPI:MERCHANT_ID');
        $this->setConfig('COMPUTOPAPI:HMAC_PASSWORD', 'COMPUTOPAPI:HMAC_PASSWORD');
        $this->setConfig('COMPUTOPAPI:BLOWFISH_PASSWORD', 'COMPUTOPAPI:BLOWFISH_PASSWORD');
        $this->setConfig('COMPUTOPAPI:RESPONSE_MAC_REQUIRED', ['INIT']);
        $this->setConfig('COMPUTOPAPI:PAYMENT_METHODS_CAPTURE_TYPES', ['computopCreditCard' => 'MANUAL']);
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createQuoteTransfer(): QuoteTransfer
    {
        $quoteTransfer = new QuoteTransfer();

        $paymentTransfer = new PaymentTransfer();
        $computopPayPalExpressPaymentTransfer = new ComputopPayPalExpressPaymentTransfer();
        $computopPayPalExpressPaymentTransfer->setData(static::DATA_VALUE);
        $computopPayPalExpressPaymentTransfer->setLen(static::LENGTH_VALUE);
        $payPalExpressPrepareResponse = new ComputopApiPayPalExpressPrepareResponseTransfer();
        $payPalExpressPrepareResponse->setTransID('');
        $computopPayPalExpressPaymentTransfer->setPayPalExpressPrepareResponse($payPalExpressPrepareResponse);
        $paymentTransfer->setComputopPayPalExpress($computopPayPalExpressPaymentTransfer);
        $quoteTransfer->setPayment($paymentTransfer);

        $totalsTransfer = new TotalsTransfer();
        $quoteTransfer->setTotals($totalsTransfer);

        return $quoteTransfer;
    }
}
