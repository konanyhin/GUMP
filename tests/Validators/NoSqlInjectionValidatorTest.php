<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class NoSqlInjectionValidatorTest extends BaseTestCase
{
    public function testSuccessWhenSafeString()
    {
        $this->assertTrue(GUMP::is_valid([
            'input' => 'normal_input',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testSuccessWhenSafeStringWithNumbers()
    {
        $this->assertTrue(GUMP::is_valid([
            'input' => 'user123',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenSelectKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'SELECT * FROM users',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenInsertKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'INSERT INTO users',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenUpdateKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'UPDATE users SET',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenDeleteKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'DELETE FROM users',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenDropKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'DROP TABLE users',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenUnionKeyword()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'UNION SELECT password',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenOrCondition()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'OR 1=1',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenAndCondition()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'AND 0=0',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenSingleQuote()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => "test'value",
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenDoubleQuote()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'test"value',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenSemicolon()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'value;',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenSqlComment()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'value--comment',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenBlockComment()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'value/*comment*/',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }

    public function testErrorWhenMixedCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'select * from users',
        ], [
            'input' => 'no_sql_injection',
        ]));
    }
}
