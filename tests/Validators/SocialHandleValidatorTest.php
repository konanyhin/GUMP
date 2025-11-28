<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class SocialHandleValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidHandle()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => 'username',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testSuccessWhenWithAtSymbol()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => '@username',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testSuccessWhenWithUnderscore()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => 'user_name',
        ], [
            'handle' => 'social_handle',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'handle' => '@user_name',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testSuccessWhenWithNumbers()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => 'user123',
        ], [
            'handle' => 'social_handle',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'handle' => '@user_123',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testSuccessWhenMinLength()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => 'a',
        ], [
            'handle' => 'social_handle',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'handle' => '@a',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testSuccessWhenMaxLength()
    {
        $this->assertTrue(GUMP::is_valid([
            'handle' => '123456789012345', // 15 chars
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testErrorWhenTooLong()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => '1234567890123456', // 16 chars
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => '',
        ], [
            'handle' => 'required|social_handle',
        ]));
    }

    public function testErrorWhenSpecialChars()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => 'user!',
        ], [
            'handle' => 'social_handle',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => 'user#name',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testErrorWhenWithSpace()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => 'user name',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testErrorWhenWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => 'user-name',
        ], [
            'handle' => 'social_handle',
        ]));
    }

    public function testErrorWhenAtInMiddle()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'handle' => 'user@name',
        ], [
            'handle' => 'social_handle',
        ]));
    }
}
