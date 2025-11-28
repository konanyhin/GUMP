<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class MinLenValidatorTest
 *
 * @package Tests
 */
class MinLenValidatorTest extends BaseTestCase
{
    public function testSuccessWhenEqual()
    {
        $this->assertTrue($this->validate('min_len,5', 'ñándú'));
    }

    public function testSuccessWhenMore()
    {
        $this->assertTrue($this->validate('min_len,2', 'ñán'));
    }

    public function testErrorWhenLess()
    {
        $this->assertNotTrue($this->validate('min_len,2', 'ñ'));
    }

    public function testWhenInputIsEmptyAndNotRequiredIsSuccess()
    {
        $this->assertTrue($this->validate('min_len,2', ''));
    }
}
