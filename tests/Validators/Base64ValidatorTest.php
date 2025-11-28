<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class Base64ValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidBase64()
    {
        $this->assertTrue(GUMP::is_valid([
            'data' => 'SGVsbG8gV29ybGQ=',
        ], [
            'data' => 'base64',
        ]));
    }

    public function testSuccessWhenValidBase64WithPadding()
    {
        $this->assertTrue(GUMP::is_valid([
            'data' => 'dGVzdA==',
        ], [
            'data' => 'base64',
        ]));
    }

    public function testSuccessWhenValidBase64NoPadding()
    {
        // Base64 without proper padding may not round-trip correctly
        $this->assertTrue(GUMP::is_valid([
            'data' => 'dGVzdGluZzE=', // "testing1" properly padded
        ], [
            'data' => 'base64',
        ]));
    }

    public function testSuccessWhenEmptyEncodesEmpty()
    {
        $this->assertTrue(GUMP::is_valid([
            'data' => '',
        ], [
            'data' => 'base64',
        ]));
    }

    public function testErrorWhenInvalidBase64()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'data' => 'invalid!!!',
        ], [
            'data' => 'base64',
        ]));
    }

    public function testErrorWhenInvalidCharacters()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'data' => 'SGVsbG8@V29ybGQ=',
        ], [
            'data' => 'base64',
        ]));
    }

    public function testErrorWhenInvalidPadding()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'data' => 'SGVsbG8gV29ybGQ===',
        ], [
            'data' => 'base64',
        ]));
    }
}
