<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class CountryCodeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidCountryCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'country' => 'US',
        ], [
            'country' => 'country_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'country' => 'GB',
        ], [
            'country' => 'country_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'country' => 'DE',
        ], [
            'country' => 'country_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'country' => 'FR',
        ], [
            'country' => 'country_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'country' => 'JP',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenLowercase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => 'us',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenMixedCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => 'Us',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenSingleLetter()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => 'U',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenThreeLetters()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => 'USA',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => '12',
        ], [
            'country' => 'country_code',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'country' => '',
        ], [
            'country' => 'required|country_code',
        ]));
    }
}
