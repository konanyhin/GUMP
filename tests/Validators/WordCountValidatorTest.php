<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class WordCountValidatorTest extends BaseTestCase
{
    public function testSuccessWhenWithinRange()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'hello world this is a test',
        ], [
            'text' => 'word_count,min;1;max;10',
        ]));
    }

    public function testSuccessWhenAtMinBoundary()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'hello',
        ], [
            'text' => 'word_count,min;1',
        ]));
    }

    public function testSuccessWhenAtMaxBoundary()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'one two three',
        ], [
            'text' => 'word_count,max;3',
        ]));
    }

    public function testSuccessWhenNoConstraints()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'any text here',
        ], [
            'text' => 'word_count',
        ]));
    }

    public function testSuccessWhenOnlyMin()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'hello world',
        ], [
            'text' => 'word_count,min;2',
        ]));
    }

    public function testSuccessWhenOnlyMax()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => 'hello',
        ], [
            'text' => 'word_count,max;5',
        ]));
    }

    public function testErrorWhenBelowMin()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'text' => 'hello',
        ], [
            'text' => 'word_count,min;5',
        ]));
    }

    public function testErrorWhenAboveMax()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'text' => 'one two three four five',
        ], [
            'text' => 'word_count,max;4',
        ]));
    }

    public function testSuccessWhenEmptyWithMinZero()
    {
        $this->assertTrue(GUMP::is_valid([
            'text' => '',
        ], [
            'text' => 'word_count,min;0',
        ]));
    }

    public function testErrorWhenEmptyWithMinOneAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'text' => '',
        ], [
            'text' => 'required|word_count,min;1',
        ]));
    }
}
