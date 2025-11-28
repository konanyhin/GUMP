<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class AlphaSpaceValidatorTest
 *
 * @package Tests
 */
class AlphaSpaceValidatorTest extends BaseTestCase
{
    public function testSuccess()
    {
        $this->assertTrue($this->validate('alpha_space', ' azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ'));
    }

    public function testError()
    {
        $this->assertNotTrue($this->validate('alpha_space', '1 azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ'));
    }

    public function testWhenInputIsEmptyAndNotRequiredIsSuccess()
    {
        $this->assertTrue($this->validate('alpha_space', ''));
    }
}
