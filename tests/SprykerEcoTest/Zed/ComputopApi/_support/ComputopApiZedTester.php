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
        $this->setConfig('COMPUTOPAPI:MERCHANT_ID', 'COMPUTOPAPI:MERCHANT_ID');
        $this->setConfig('COMPUTOPAPI:HMAC_PASSWORD', 'COMPUTOPAPI:HMAC_PASSWORD');
        $this->setConfig('COMPUTOPAPI:BLOWFISH_PASSWORD', 'COMPUTOPAPI:BLOWFISH_PASSWORD');
        $this->setConfig('COMPUTOPAPI:RESPONSE_MAC_REQUIRED', ['INIT']);
    }
}
