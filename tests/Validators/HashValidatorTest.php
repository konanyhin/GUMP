<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class HashValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidMd5()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'd41d8cd98f00b204e9800998ecf8427e',
        ], [
            'hash' => 'hash,md5',
        ]));
    }

    public function testSuccessWhenValidMd5Uppercase()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'D41D8CD98F00B204E9800998ECF8427E',
        ], [
            'hash' => 'hash,md5',
        ]));
    }

    public function testSuccessWhenValidSha1()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'da39a3ee5e6b4b0d3255bfef95601890afd80709',
        ], [
            'hash' => 'hash,sha1',
        ]));
    }

    public function testSuccessWhenValidSha256()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
        ], [
            'hash' => 'hash,sha256',
        ]));
    }

    public function testSuccessWhenValidSha512()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e',
        ], [
            'hash' => 'hash,sha512',
        ]));
    }

    public function testSuccessWhenDefaultMd5()
    {
        $this->assertTrue(GUMP::is_valid([
            'hash' => 'd41d8cd98f00b204e9800998ecf8427e',
        ], [
            'hash' => 'hash',
        ]));
    }

    public function testErrorWhenHashTooShort()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'hash' => 'd41d8cd98f00b204',
        ], [
            'hash' => 'hash,md5',
        ]));
    }

    public function testErrorWhenHashTooLong()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'hash' => 'd41d8cd98f00b204e9800998ecf8427e00',
        ], [
            'hash' => 'hash,md5',
        ]));
    }

    public function testErrorWhenContainsNonHexCharacters()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'hash' => 'g41d8cd98f00b204e9800998ecf8427e',
        ], [
            'hash' => 'hash,md5',
        ]));
    }

    public function testErrorWhenUnsupportedAlgorithm()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'hash' => 'd41d8cd98f00b204e9800998ecf8427e',
        ], [
            'hash' => 'hash,unsupported',
        ]));
    }
}
