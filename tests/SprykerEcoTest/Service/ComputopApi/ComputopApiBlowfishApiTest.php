<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Service\ComputopApi;

use SprykerEco\Service\ComputopApi\Exception\BlowfishException;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasher;
use SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface;

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
    public const PLAINTEXT_VALUE = 'plaintext';
    public const LENGTH_VALUE = 9;
    public const PASSWORD_VALUE = 'password';

    public const CIPHER_VALUE = '14ec7a6da0fbb3e50a84b47302443328';
    public const CIPHER_LENGTH_VALUE = 16;

    /**
     * @return void
     */
    public function testBlowfishCrypt(): void
    {
        $service = $this->createService();
        $encryptedValue = $service->getBlowfishEncryptedValue(
            self::PLAINTEXT_VALUE,
            self::LENGTH_VALUE,
            self::PASSWORD_VALUE
        );

        $this->assertSame(self::CIPHER_VALUE, $encryptedValue);
    }

    /**
     * @return void
     */
    public function testBlowfishCryptError(): void
    {
        $this->expectException(BlowfishException::class);

        $service = $this->createService();
        $service->getBlowfishEncryptedValue(
            self::PLAINTEXT_VALUE,
            (self::LENGTH_VALUE - 1),
            self::PASSWORD_VALUE
        );
    }

    /**
     * @return void
     */
    public function testBlowfishDecrypt(): void
    {
        $service = $this->createService();
        $decryptedValue = $service->getBlowfishDecryptedValue(
            self::CIPHER_VALUE,
            self::CIPHER_LENGTH_VALUE,
            self::PASSWORD_VALUE
        );

        $this->assertSame(self::PLAINTEXT_VALUE, trim($decryptedValue));
    }

    /**
     * @return void
     */
    public function testBlowfishDecryptError(): void
    {
        $this->expectException(BlowfishException::class);

        $service = $this->createService();
        $service->getBlowfishDecryptedValue(
            self::CIPHER_VALUE,
            self::CIPHER_LENGTH_VALUE + 1,
            self::PASSWORD_VALUE
        );
    }

    /**
     * @return \SprykerEco\Service\ComputopApi\Hasher\BlowfishHasherInterface
     */
    public function createService(): BlowfishHasherInterface
    {
        return new BlowfishHasher();
    }
}
