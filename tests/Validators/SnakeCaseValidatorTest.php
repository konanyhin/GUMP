<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class SnakeCaseValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidSnakeCase()
    {
        $this->assertTrue(GUMP::is_valid([
            'name' => 'hello_world',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testSuccessWhenSingleWord()
    {
        $this->assertTrue(GUMP::is_valid([
            'name' => 'hello',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testSuccessWhenMultipleUnderscores()
    {
        $this->assertTrue(GUMP::is_valid([
            'name' => 'my_variable_name',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testSuccessWhenWithNumbers()
    {
        $this->assertTrue(GUMP::is_valid([
            'name' => 'var_123',
        ], [
            'name' => 'snake_case',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'name' => 'test_1_2_3',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenCamelCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => 'helloWorld',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenPascalCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => 'HelloWorld',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenStartsWithNumber()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => '1_hello',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenStartsWithUppercase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => 'Hello_world',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => 'hello-world',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenWithSpace()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => 'hello world',
        ], [
            'name' => 'snake_case',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'name' => '',
        ], [
            'name' => 'required|snake_case',
        ]));
    }
}
