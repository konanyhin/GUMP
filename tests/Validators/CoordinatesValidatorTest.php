<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class CoordinatesValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidCoordinates()
    {
        $this->assertTrue(GUMP::is_valid([
            'coords' => '40.7128, -74.0060',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testSuccessWhenEquator()
    {
        $this->assertTrue(GUMP::is_valid([
            'coords' => '0, 0',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testSuccessWhenNegativeCoordinates()
    {
        $this->assertTrue(GUMP::is_valid([
            'coords' => '-33.8688, 151.2093',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testSuccessWhenBoundaryCoordinates()
    {
        $this->assertTrue(GUMP::is_valid([
            'coords' => '90, 180',
        ], [
            'coords' => 'coordinates',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'coords' => '-90, -180',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testSuccessWhenNoSpaceAfterComma()
    {
        $this->assertTrue(GUMP::is_valid([
            'coords' => '40.7128,-74.0060',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testErrorWhenLatitudeTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => '91, 0',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testErrorWhenLatitudeTooLow()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => '-91, 0',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testErrorWhenLongitudeTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => '0, 181',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testErrorWhenLongitudeTooLow()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => '0, -181',
        ], [
            'coords' => 'coordinates',
        ]));
    }

    public function testErrorWhenInvalidFormat()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => '40.7128',
        ], [
            'coords' => 'coordinates',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'coords' => 'invalid',
        ], [
            'coords' => 'coordinates',
        ]));
    }
}
