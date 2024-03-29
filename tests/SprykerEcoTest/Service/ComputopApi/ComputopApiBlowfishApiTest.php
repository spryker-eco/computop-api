<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use SprykerEco\Service\ComputopApi\Exception\BlowfishException;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasher;

/**
 * @group Unit
 * @group SprykerEco
 * @group Service
 * @group ComputopApi
 * @group Api
 * @group ComputopApiBlowfishTest
 */
class ComputopApiBlowfishApiTest extends AbstractComputopApiTest
{
    /**
     * @var string
     */
    public const PLAINTEXT_VALUE = 'plaintext';

    /**
     * @var int
     */
    public const LENGTH_VALUE = 9;

    /**
     * @var string
     */
    public const PASSWORD_VALUE = 'password';

    /**
     * @var string
     */
    public const CIPHER_VALUE = '14ec7a6da0fbb3e50a84b47302443328';

    /**
     * @var int
     */
    public const CIPHER_LENGTH_VALUE = 16;

    /**
     * @return void
     */
    public function testBlowfishCrypt()
    {
        $service = $this->createService();
        $encryptedValue = $service->getBlowfishEncryptedValue(
            static::PLAINTEXT_VALUE,
            static::LENGTH_VALUE,
            static::PASSWORD_VALUE,
        );

        $this->assertSame(static::CIPHER_VALUE, $encryptedValue);
    }

    /**
     * @return void
     */
    public function testBlowfishCryptError()
    {
        $this->expectException(BlowfishException::class);

        $service = $this->createService();
        $service->getBlowfishEncryptedValue(
            static::PLAINTEXT_VALUE,
            (static::LENGTH_VALUE - 1),
            static::PASSWORD_VALUE,
        );
    }

    /**
     * @return void
     */
    public function testBlowfishDecrypt()
    {
        $service = $this->createService();
        $decryptedValue = $service->getBlowfishDecryptedValue(
            static::CIPHER_VALUE,
            static::CIPHER_LENGTH_VALUE,
            static::PASSWORD_VALUE,
        );

        $this->assertSame(static::PLAINTEXT_VALUE, trim($decryptedValue));
    }

    /**
     * @return void
     */
    public function testBlowfishDecryptError()
    {
        $this->expectException(BlowfishException::class);

        $service = $this->createService();
        $service->getBlowfishDecryptedValue(
            static::CIPHER_VALUE,
            static::CIPHER_LENGTH_VALUE + 1,
            static::PASSWORD_VALUE,
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface
     */
    public function createService()
    {
        return new BlowfishHasher();
    }
}
