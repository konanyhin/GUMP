<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class DomainNameValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidDomain()
    {
        $this->assertTrue(GUMP::is_valid([
            'domain' => 'example.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testSuccessWhenValidSubdomain()
    {
        $this->assertTrue(GUMP::is_valid([
            'domain' => 'subdomain.example.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testSuccessWhenMultipleSubdomains()
    {
        $this->assertTrue(GUMP::is_valid([
            'domain' => 'a.b.c.example.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testSuccessWhenDomainWithHyphen()
    {
        $this->assertTrue(GUMP::is_valid([
            'domain' => 'my-domain.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testSuccessWhenLongTld()
    {
        $this->assertTrue(GUMP::is_valid([
            'domain' => 'example.museum',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenNoTld()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => 'example',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenWithProtocol()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => 'http://example.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenStartsWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => '-example.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenEndsWithHyphen()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => 'example-.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenWithUnderscore()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => 'example_domain.com',
        ], [
            'domain' => 'domain_name',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'domain' => '',
        ], [
            'domain' => 'required|domain_name',
        ]));
    }
}
