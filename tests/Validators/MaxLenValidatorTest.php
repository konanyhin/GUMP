<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class MaxLenValidatorTest
 *
 * @package Tests
 */
class MaxLenValidatorTest extends BaseTestCase
{
    public function testSuccessWhenEqual()
    {
        $this->assertTrue($this->validate('max_len,5', 'ñándú'));
    }

    public function testSuccessWhenLess()
    {
        $this->assertTrue($this->validate('max_len,2', 'ñ'));
    }

    public function testErrorWhenMore()
    {
        $this->assertNotTrue($this->validate('max_len,2', 'ñán'));
    }

    public function testWhenInputIsEmptyAndNotRequiredIsSuccess()
    {
        $this->assertTrue($this->validate('max_len,2', ''));
    }
}
