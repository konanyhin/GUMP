<?php

namespace Tests\Filters;

use Tests\BaseTestCase;

/**
 * Class RmpunctuationFilterTest
 *
 * @package Tests
 */
class RmpunctuationFilterTest extends BaseTestCase
{
    public const FILTER = 'rmpunctuation';

    /**
     * @dataProvider successProvider
     */
    public function testSuccess($input, $expected)
    {
        $result = $this->filter(self::FILTER, $input);

        $this->assertEquals($expected, $result);
    }

    public function successProvider()
    {
        return [
            ['hello?!:;', 'hello'],
        ];
    }
}
