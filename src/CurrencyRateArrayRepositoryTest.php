<?php

namespace App;

use PHPUnit\Framework\TestCase;

class CurrencyRateArrayRepositoryTest extends TestCase
{
    public function testHasCurrencyRateExists()
    {
        $source_currency = new Currency('USD');
        $target_currency = new Currency('RUB');

        $rate = new CurrencyRate(
            $source_currency,
            $target_currency,
            '65.57'
        );

        $currency_rate_repository = new CurrencyRateArrayRepository();
        $currency_rate_repository->add($rate);

        $this->assertTrue($currency_rate_repository->has($source_currency, $target_currency));
    }

    public function testHasCurrencyRateDoesNotExists()
    {
        $source_currency = new Currency('USD');
        $target_currency = new Currency('EUR');

        $rate = new CurrencyRate(
            $source_currency,
            $target_currency,
            '0.87'
        );

        $currency_rate_repository = new CurrencyRateArrayRepository();
        $currency_rate_repository->add($rate);

        $this->assertFalse($currency_rate_repository->has($source_currency, new Currency('RUB')));
    }

    public function testGetSuccessfully()
    {
        $source_currency = new Currency('USD');
        $target_currency = new Currency('EUR');

        $rate = new CurrencyRate(
            $source_currency,
            $target_currency,
            '0.87'
        );

        $currency_rate_repository = new CurrencyRateArrayRepository();
        $currency_rate_repository->add($rate);

        $rate = $currency_rate_repository->get($source_currency, $target_currency);

        $this->assertEquals($source_currency->code(), $rate->sourceCurrency()->code());
        $this->assertEquals($target_currency->code(), $rate->targetCurrency()->code());
    }

    public function testGetFailed()
    {
        $source_currency = new Currency('USD');
        $target_currency = new Currency('EUR');

        $rate = new CurrencyRate(
            $source_currency,
            $target_currency,
            '0.87'
        );

        $currency_rate_repository = new CurrencyRateArrayRepository();
        $currency_rate_repository->add($rate);

        $this->expectException(RateNotFoundException::class);
        $currency_rate_repository->get($source_currency, new Currency('RUB'));
    }
}
