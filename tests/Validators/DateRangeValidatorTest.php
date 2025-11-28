<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class DateRangeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenDateWithinRange()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-06-15',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testSuccessWhenDateAtStartBoundary()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-01-01',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testSuccessWhenDateAtEndBoundary()
    {
        $this->assertTrue(GUMP::is_valid([
            'date' => '2024-12-31',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testErrorWhenDateBeforeRange()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2023-12-31',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testErrorWhenDateAfterRange()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2025-01-01',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testErrorWhenInvalidDateFormat()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => 'not-a-date',
        ], [
            'date' => 'date_range,2024-01-01;2024-12-31',
        ]));
    }

    public function testErrorWhenMissingParameter()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'date' => '2024-06-15',
        ], [
            'date' => 'date_range,2024-01-01',
        ]));
    }
}
