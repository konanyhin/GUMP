<?php

namespace Tests\Validators;

use GUMP;
use Tests\BaseTestCase;

class CurrencyCodeValidatorTest extends BaseTestCase
{
    public function testSuccessWhenValidCurrencyCode()
    {
        $validCurrencies = ['USD', 'EUR', 'GBP', 'JPY', 'AUD', 'CAD', 'CHF', 'CNY'];

        foreach ($validCurrencies as $currency) {
            $this->assertTrue(GUMP::is_valid([
                'currency' => $currency,
            ], [
                'currency' => 'currency_code',
            ]), "Failed asserting that $currency is valid");
        }
    }

    public function testSuccessWhenLessCommonCurrency()
    {
        $this->assertTrue(GUMP::is_valid([
            'currency' => 'RUB',
        ], [
            'currency' => 'currency_code',
        ]));

        $this->assertTrue(GUMP::is_valid([
            'currency' => 'ZAR',
        ], [
            'currency' => 'currency_code',
        ]));
    }

    public function testErrorWhenInvalidCurrencyCode()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => 'XXX',
        ], [
            'currency' => 'currency_code',
        ]));
    }

    public function testErrorWhenLowercase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => 'usd',
        ], [
            'currency' => 'currency_code',
        ]));
    }

    public function testErrorWhenMixedCase()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => 'Usd',
        ], [
            'currency' => 'currency_code',
        ]));
    }

    public function testErrorWhenWithSpaces()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => 'US D',
        ], [
            'currency' => 'currency_code',
        ]));
    }

    public function testErrorWhenEmptyAndRequired()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => '',
        ], [
            'currency' => 'required|currency_code',
        ]));
    }

    public function testErrorWhenNumeric()
    {
        $this->assertNotSame(true, GUMP::is_valid([
            'currency' => '840',
        ], [
            'currency' => 'currency_code',
        ]));
    }
}
