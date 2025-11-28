<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class NoXssValidatorTest extends BaseTestCase
{
    public function testSuccessWhenSafeString()
    {
        $this->assertTrue(GUMP::is_valid([
            'input' => 'normal text',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testSuccessWhenSafeHtml()
    {
        $this->assertTrue(GUMP::is_valid([
            'input' => '<p>Hello World</p>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenScriptTag()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<script>alert("xss")</script>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenJavascriptProtocol()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'javascript:alert("xss")',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenOnclickHandler()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<div onclick=alert("xss")>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenOnloadHandler()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<img onload=alert("xss")>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenOnerrorHandler()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<img onerror=alert("xss")>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenIframeTag()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<iframe src="evil.com"></iframe>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenObjectTag()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<object data="evil.swf"></object>',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenEmbedTag()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<embed src="evil.swf">',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenCssExpression()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'expression(alert("xss"))',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenVbscriptProtocol()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => 'vbscript:alert("xss")',
        ], [
            'input' => 'no_xss',
        ]));
    }

    public function testErrorWhenMixedCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'input' => '<SCRIPT>alert("xss")</SCRIPT>',
        ], [
            'input' => 'no_xss',
        ]));
    }
}
