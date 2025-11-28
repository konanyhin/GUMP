<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class ValidCcValidatorTest
 *
 * @package Tests
 */
class ValidCcValidatorTest extends BaseTestCase
{
    public const RULE = 'valid_cc';

    /**
     * @dataProvider successProvider
     */
    public function testSuccess($input)
    {
        $this->assertTrue($this->validate(self::RULE, $input));
    }

    public function successProvider()
    {
        return [
            ['5105105105105100'],
        ];
    }

    /**
     * @dataProvider errorProvider
     */
    public function testError($input)
    {
        $this->assertNotTrue($this->validate(self::RULE, $input));
    }

    public function errorProvider()
    {
        return [
            [ '5105105105105101' ],
            [ '1212121212121212' ],
            [ 'text' ],
        ];
    }

    public function testWhenInputIsEmptyAndNotRequiredIsSuccess()
    {
        $this->assertTrue($this->validate(self::RULE, ''));
    }
}
