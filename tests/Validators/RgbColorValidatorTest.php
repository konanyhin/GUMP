<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class RgbColorValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidRgb()
    {
        $this->assertTrue(GUMP::is_valid([
            'color' => 'rgb(255, 128, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testSuccessWhenBlack()
    {
        $this->assertTrue(GUMP::is_valid([
            'color' => 'rgb(0, 0, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testSuccessWhenWhite()
    {
        $this->assertTrue(GUMP::is_valid([
            'color' => 'rgb(255, 255, 255)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testSuccessWhenExtraSpaces()
    {
        $this->assertTrue(GUMP::is_valid([
            'color' => 'rgb( 255 , 128 , 0 )',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testSuccessWhenMixedCase()
    {
        $this->assertTrue(GUMP::is_valid([
            'color' => 'RGB(255, 128, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenRedTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => 'rgb(256, 128, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenGreenTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => 'rgb(255, 256, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenBlueTooHigh()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => 'rgb(255, 128, 256)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenHexFormat()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => '#FF8000',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenMissingRgb()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => '(255, 128, 0)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenNonNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => 'rgb(a, b, c)',
        ], [
            'color' => 'rgb_color',
        ]));
    }

    public function testErrorWhenRgba()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'color' => 'rgba(255, 128, 0, 1)',
        ], [
            'color' => 'rgb_color',
        ]));
    }
}
