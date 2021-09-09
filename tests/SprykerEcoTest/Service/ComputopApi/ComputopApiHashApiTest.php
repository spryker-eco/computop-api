<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use SprykerEco\Service\ComputopApi\Hasher\HmacHasher;

/**
 * @group Unit
 * @group SprykerEco
 * @group Service
 * @group ComputopApi
 * @group Api
 * @group ComputopApiHashTest
 */
class ComputopApiHashApiTest extends AbstractComputopApiTest
{
    protected const VALUE = 'value';
    protected const EXPECTED_VALUE = '18B40402BBF3FEED824E9F762B412F1108C4D678B2A067425B99963CD68B1D6A';

    /**
     * @return void
     */
    public function testHashCrypt()
    {
        $service = $this->createService();
        $encryptedValue = $service->getEncryptedValue(self::VALUE);

        $this->assertSame(self::EXPECTED_VALUE, $encryptedValue);
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Hasher\HmacHasherInterface
     */
    public function createService()
    {
        return new HmacHasher($this->helper->createComputopConfigMock());
    }
}
