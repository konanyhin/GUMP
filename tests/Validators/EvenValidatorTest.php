<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class EvenValidatorTest extends BaseTestCase
{
    public function testSuccessWhenEvenNumber()
    {
        $evenNumbers = [0, 2, 4, 6, 8, 10, 100, 1000];

        foreach ($evenNumbers as $even) {
            $this->assertTrue(GUMP::is_valid([
                'number' => (string)$even,
            ], [
                'number' => 'even',
            ]), "Failed asserting that $even is even");
        }
    }

    public function testSuccessWhenNegativeEvenNumber()
    {
        $this->assertTrue(GUMP::is_valid([
            'number' => '-2',
        ], [
            'number' => 'even',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'number' => '-4',
        ], [
            'number' => 'even',
        ]));
    }

    public function testSuccessWhenZero()
    {
        $this->assertTrue(GUMP::is_valid([
            'number' => '0',
        ], [
            'number' => 'even',
        ]));
    }

    public function testErrorWhenOddNumber()
    {
        $oddNumbers = [1, 3, 5, 7, 9, 11, 99, 101];

        foreach ($oddNumbers as $odd) {
            $this->assertNotSame(true, GUMP::is_valid([
                'number' => (string)$odd,
            ], [
                'number' => 'even',
            ]), "Failed asserting that $odd is not even");
        }
    }

    public function testErrorWhenNegativeOddNumber()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-1',
        ], [
            'number' => 'even',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'number' => '-3',
        ], [
            'number' => 'even',
        ]));
    }

    public function testErrorWhenNotNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'number' => 'abc',
        ], [
            'number' => 'even',
        ]));
    }

    public function testSuccessWhenFloat()
    {
        // Floats are cast to int, so 2.5 becomes 2 which is even
        $this->assertTrue(GUMP::is_valid([
            'number' => '2.5',
        ], [
            'number' => 'even',
        ]));
    }
}
