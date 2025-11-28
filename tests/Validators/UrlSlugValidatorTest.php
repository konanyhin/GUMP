<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class UrlSlugValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidSlug()
    {
        $this->assertTrue(GUMP::is_valid([
            'slug' => 'hello-world',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testSuccessWhenSingleWord()
    {
        $this->assertTrue(GUMP::is_valid([
            'slug' => 'hello',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testSuccessWhenMultipleHyphens()
    {
        $this->assertTrue(GUMP::is_valid([
            'slug' => 'my-awesome-post',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testSuccessWhenWithNumbers()
    {
        $this->assertTrue(GUMP::is_valid([
            'slug' => 'test123',
        ], [
            'slug' => 'url_slug',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'slug' => 'hello-world-123',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testSuccessWhenSingleCharacter()
    {
        $this->assertTrue(GUMP::is_valid([
            'slug' => 'a',
        ], [
            'slug' => 'url_slug',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'slug' => '9',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenUppercase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => 'Hello-World',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenStartsWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => '-hello-world',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenEndsWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => 'hello-world-',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenConsecutiveHyphens()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => 'hello--world',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenWithSpace()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => 'hello world',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenWithUnderscore()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => 'hello_world',
        ], [
            'slug' => 'url_slug',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'slug' => '',
        ], [
            'slug' => 'required|url_slug',
        ]));
    }
}
