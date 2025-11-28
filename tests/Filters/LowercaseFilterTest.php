<?php

namespace Tests\Filters;

use Tests\BaseTestCase;

/**
 * Class LowerFilterTest
 *
 * @package Tests
 */
class LowerFilterTest extends BaseTestCase
{
    public const FILTER = 'lower_case';

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
            ['Hello', 'hello'],
        ];
    }
}
