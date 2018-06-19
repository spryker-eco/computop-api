<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopApi;

use Codeception\Actor;
use Codeception\Scenario;

/**
 * Inherited Methods
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
        $this->setConfig('COMPUTOP_API:MERCHANT_ID', 'COMPUTOP_API:MERCHANT_ID');
        $this->setConfig('COMPUTOP_API:HMAC_PASSWORD', 'COMPUTOP_API:HMAC_PASSWORD');
        $this->setConfig('COMPUTOP_API:BLOWFISH_PASSWORD', 'COMPUTOP_API:BLOWFISH_PASSWORD');
        $this->setConfig('COMPUTOP_API:RESPONSE_MAC_REQUIRED', ['INIT']);
    }
}
