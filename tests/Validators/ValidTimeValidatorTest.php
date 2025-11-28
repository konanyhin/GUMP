<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class ValidTimeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidTimeHHMM()
    {
        $this->assertTrue(GUMP::is_valid([
            'time' => '12:30',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testSuccessWhenValidTimeHHMMSS()
    {
        $this->assertTrue(GUMP::is_valid([
            'time' => '12:30:45',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testSuccessWhenMidnight()
    {
        $this->assertTrue(GUMP::is_valid([
            'time' => '00:00',
        ], [
            'time' => 'valid_time',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'time' => '00:00:00',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testSuccessWhenEndOfDay()
    {
        $this->assertTrue(GUMP::is_valid([
            'time' => '23:59',
        ], [
            'time' => 'valid_time',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'time' => '23:59:59',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testSuccessWhenSingleDigitHour()
    {
        $this->assertTrue(GUMP::is_valid([
            'time' => '9:30',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testErrorWhenHourTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '24:00',
        ], [
            'time' => 'valid_time',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '25:00',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testErrorWhenMinuteTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '12:60',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testErrorWhenSecondTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '12:30:60',
        ], [
            'time' => 'valid_time',
        ]));
    }

    public function testErrorWhenInvalidFormat()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '12',
        ], [
            'time' => 'valid_time',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '12.30',
        ], [
            'time' => 'valid_time',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'time' => '1230',
        ], [
            'time' => 'valid_time',
        ]));
    }
}
