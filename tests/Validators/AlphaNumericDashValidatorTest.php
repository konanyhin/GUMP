<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class AlphaNumericDashValidatorTest
 *
 * @package Tests
 */
class AlphaNumericDashValidatorTest extends BaseTestCase
{
    public function testSuccess()
    {
        $this->assertTrue($this->validate('alpha_numeric_dash', 'azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ123-_'));
    }

    public function testError()
    {
        $this->assertNotTrue($this->validate('alpha_numeric_dash', 'azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ123-_ '));
    }

    public function testWhenInputIsEmptyAndNotRequiredIsSuccess()
    {
        $this->assertTrue($this->validate('alpha_numeric_dash', ''));
    }
}
