<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class LanguageCodeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidTwoLetterCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'lang' => 'en',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lang' => 'fr',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lang' => 'de',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lang' => 'ja',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testSuccessWhenValidWithCountryCode()
    {
        $this->assertTrue(GUMP::is_valid([
            'lang' => 'en-US',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lang' => 'fr-FR',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'lang' => 'zh-CN',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenUppercaseLanguage()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'EN',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenSingleLetter()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'e',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenThreeLetters()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'eng',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenWrongCaseFormat()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'En-us',
        ], [
            'lang' => 'language_code',
        ]));

        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'EN-US',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenUnderscoreSeparator()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => 'en_US',
        ], [
            'lang' => 'language_code',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'lang' => '',
        ], [
            'lang' => 'required|language_code',
        ]));
    }
}
