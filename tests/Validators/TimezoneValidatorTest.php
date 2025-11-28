<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class TimezoneValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidTimezone()
    {
        $this->assertTrue(GUMP::is_valid([
            'tz' => 'America/New_York',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testSuccessWhenValidEuropeanTimezone()
    {
        $this->assertTrue(GUMP::is_valid([
            'tz' => 'Europe/London',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testSuccessWhenValidAsianTimezone()
    {
        $this->assertTrue(GUMP::is_valid([
            'tz' => 'Asia/Tokyo',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testSuccessWhenUTC()
    {
        $this->assertTrue(GUMP::is_valid([
            'tz' => 'UTC',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testSuccessWhenAustralianTimezone()
    {
        $this->assertTrue(GUMP::is_valid([
            'tz' => 'Australia/Sydney',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testErrorWhenInvalidTimezone()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'tz' => 'America/Invalid_City',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testErrorWhenPartialTimezone()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'tz' => 'New York',
        ], [
            'tz' => 'timezone',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'tz' => '',
        ], [
            'tz' => 'required|timezone',
        ]));
    }
}
