<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class BusinessDayValidatorTest extends BaseTestCase
{
    public function testSuccessWhenMonday()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-08', // Monday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testSuccessWhenTuesday()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-09', // Tuesday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testSuccessWhenWednesday()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-10', // Wednesday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testSuccessWhenThursday()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-11', // Thursday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testSuccessWhenFriday()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-12', // Friday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testErrorWhenSaturday()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2024-01-13', // Saturday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testErrorWhenSunday()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2024-01-14', // Sunday
        ], [
            'date' => 'business_day',
        ]));
    }

    public function testErrorWhenInvalidDate()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => 'not-a-date',
        ], [
            'date' => 'business_day',
        ]));
    }
}
