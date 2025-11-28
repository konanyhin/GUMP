<?php

namespace Tests\Filters;

use Tests\BaseTestCase;

/**
 * Class HtmlencodeFilterTest
 *
 * @package Tests
 */
class HtmlencodeFilterTest extends BaseTestCase
{
    public const FILTER = 'htmlencode';

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
            ['Is Peter <smart> & funny', 'Is Peter &#60;smart&#62; &#38; funny'],
        ];
    }
}
