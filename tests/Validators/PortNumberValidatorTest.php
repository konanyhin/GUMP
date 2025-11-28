<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class PortNumberValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidPort()
    {
        $this->assertTrue(GUMP::is_valid([
            'port' => '80',
        ], [
            'port' => 'port_number',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'port' => '443',
        ], [
            'port' => 'port_number',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'port' => '8080',
        ], [
            'port' => 'port_number',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'port' => '3306',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testSuccessWhenMinimumPort()
    {
        $this->assertTrue(GUMP::is_valid([
            'port' => '1',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testSuccessWhenMaximumPort()
    {
        $this->assertTrue(GUMP::is_valid([
            'port' => '65535',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testErrorWhenPortZero()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'port' => '0',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testErrorWhenNegativePort()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'port' => '-1',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testErrorWhenPortTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'port' => '65536',
        ], [
            'port' => 'port_number',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'port' => '99999',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testErrorWhenNotNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'port' => 'abc',
        ], [
            'port' => 'port_number',
        ]));
    }

    public function testSuccessWhenFloat()
    {
        // Floats are numeric and within range, so they pass
        $this->assertTrue(GUMP::is_valid([
            'port' => '8080.5',
        ], [
            'port' => 'port_number',
        ]));
    }
}
