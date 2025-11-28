<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class PostalCodeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidUSPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '12345',
        ], [
            'zip' => 'postal_code,US',
        ]));
    }

    public function testSuccessWhenValidUSPostalCodeWithExtension()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '12345-6789',
        ], [
            'zip' => 'postal_code,US',
        ]));
    }

    public function testSuccessWhenValidCanadianPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => 'K1A 0B1',
        ], [
            'zip' => 'postal_code,CA',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'zip' => 'K1A0B1',
        ], [
            'zip' => 'postal_code,CA',
        ]));
    }

    public function testSuccessWhenValidUKPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => 'SW1A 1AA',
        ], [
            'zip' => 'postal_code,UK',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'zip' => 'B33 8TH',
        ], [
            'zip' => 'postal_code,UK',
        ]));
    }

    public function testSuccessWhenValidGermanPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '10115',
        ], [
            'zip' => 'postal_code,DE',
        ]));
    }

    public function testSuccessWhenValidFrenchPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '75001',
        ], [
            'zip' => 'postal_code,FR',
        ]));
    }

    public function testSuccessWhenValidAustralianPostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '2000',
        ], [
            'zip' => 'postal_code,AU',
        ]));
    }

    public function testSuccessWhenValidJapanesePostalCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '100-0001',
        ], [
            'zip' => 'postal_code,JP',
        ]));
    }

    public function testSuccessWhenDefaultUS()
    {
        $this->assertTrue(GUMP::is_valid([
            'zip' => '12345',
        ], [
            'zip' => 'postal_code',
        ]));
    }

    public function testErrorWhenInvalidUSPostalCode()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'zip' => '1234',
        ], [
            'zip' => 'postal_code,US',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'zip' => '12345-678',
        ], [
            'zip' => 'postal_code,US',
        ]));
    }

    public function testErrorWhenInvalidCountryCode()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'zip' => '12345',
        ], [
            'zip' => 'postal_code,XX',
        ]));
    }
}
