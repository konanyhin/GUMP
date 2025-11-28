<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class LongitudeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidLongitude()
    {
        $this->assertTrue(GUMP::is_valid([
            'lng' => '74.0060',
        ], [
            'lng' => 'longitude',
        ]));
    }

    public function testSuccessWhenValidNegativeLongitude()
    {
        $this->assertTrue(GUMP::is_valid([
            'lng' => '-74.0060',
        ], [
            'lng' => 'longitude',
        ]));
    }

    public function testSuccessWhenValidBoundaryLongitude()
    {
        $this->assertTrue(GUMP::is_valid([
            'lng' => '180',
        ], [
            'lng' => 'longitude',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lng' => '-180',
        ], [
            'lng' => 'longitude',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lng' => '0',
        ], [
            'lng' => 'longitude',
        ]));
    }

    public function testErrorWhenLongitudeTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lng' => '181',
        ], [
            'lng' => 'longitude',
        ]));
    }

    public function testErrorWhenLongitudeTooLow()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lng' => '-181',
        ], [
            'lng' => 'longitude',
        ]));
    }

    public function testErrorWhenNotNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lng' => 'not-a-number',
        ], [
            'lng' => 'longitude',
        ]));
    }
}
