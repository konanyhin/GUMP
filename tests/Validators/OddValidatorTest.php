<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class OddValidatorTest extends BaseTestCase
{
    public function testSuccessWhenOddNumber()
    {
        $oddNumbers = [1, 3, 5, 7, 9, 11, 99, 101];

        foreach ($oddNumbers as $odd) {
            $this->assertTrue(GUMP::is_valid([
                'number' => (string)$odd,
            ], [
                'number' => 'odd',
            ]), "Failed asserting that $odd is odd");
        }
    }

    public function testErrorWhenNegativeOddNumber()
    {
        // In PHP, -1 % 2 = -1, not 1, so negative odd numbers fail this validator
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-1',
        ], [
            'number' => 'odd',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-3',
        ], [
            'number' => 'odd',
        ]));
    }

    public function testErrorWhenEvenNumber()
    {
        $evenNumbers = [0, 2, 4, 6, 8, 10, 100];

        foreach ($evenNumbers as $even) {
            $this->assertNotSame(true, GUMP::is_valid([
                'number' => (string)$even,
            ], [
                'number' => 'odd',
            ]), "Failed asserting that $even is not odd");
        }
    }

    public function testErrorWhenNegativeEvenNumber()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-2',
        ], [
            'number' => 'odd',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-4',
        ], [
            'number' => 'odd',
        ]));
    }

    public function testErrorWhenZero()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '0',
        ], [
            'number' => 'odd',
        ]));
    }

    public function testErrorWhenNotNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => 'abc',
        ], [
            'number' => 'odd',
        ]));
    }

    public function testSuccessWhenFloat()
    {
        // Floats are cast to int, so 3.5 becomes 3 which is odd
        $this->assertTrue(GUMP::is_valid([
            'number' => '3.5',
        ], [
            'number' => 'odd',
        ]));
    }
}
