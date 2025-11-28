<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class PastDateValidatorTest extends BaseTestCase
{
    public function testSuccessWhenPastDate()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2020-01-01',
        ], [
            'date' => 'past_date',
        ]));
    }

    public function testSuccessWhenFarPastDate()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '1990-06-15',
        ], [
            'date' => 'past_date',
        ]));
    }

    public function testSuccessWhenYesterday()
    {
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->assertTrue(GUMP::is_valid([
            'date' => $yesterday,
        ], [
            'date' => 'past_date',
        ]));
    }

    public function testErrorWhenFutureDate()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2099-12-31',
        ], [
            'date' => 'past_date',
        ]));
    }

    public function testErrorWhenTomorrow()
    {
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => $tomorrow,
        ], [
            'date' => 'past_date',
        ]));
    }

    public function testErrorWhenInvalidDate()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => 'not-a-date',
        ], [
            'date' => 'past_date',
        ]));
    }
}
