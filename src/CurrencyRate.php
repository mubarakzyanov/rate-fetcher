<?php

namespace App;

class CurrencyRate
{
    /**
     * @var string
     */
    private $rate;

    /**
     * @var Currency
     */
    private $source_currency;

    /**
     * @var Currency
     */
    private $target_currency;

    public function __construct(Currency $source_currency, Currency $target_currency, string $rate)
    {
        $this->rate = $rate;
        $this->source_currency = $source_currency;
        $this->target_currency = $target_currency;
    }

    public function rate(): string
    {
        return $this->rate;
    }

    public function sourceCurrency(): Currency
    {
        return $this->source_currency;
    }

    public function targetCurrency(): Currency
    {
        return $this->target_currency;
    }
}