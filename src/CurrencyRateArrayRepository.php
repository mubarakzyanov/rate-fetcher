<?php
namespace App;

use App\Contract\CurrencyRateRepository;

class CurrencyRateArrayRepository implements CurrencyRateRepository
{
    /**
     * @var CurrencyRate[]
     */
    private $rates = [];

    public function add(CurrencyRate $rate)
    {
        $this->rates[] = $rate;
    }

    public function has(Currency $source_currency, Currency $target_currency): bool
    {
        return (bool) array_filter($this->rates, function(CurrencyRate $rate) use ($target_currency, $source_currency) {
            return $rate->sourceCurrency()->code() === $source_currency->code()
                && $rate->targetCurrency()->code() === $target_currency->code();
        });
    }

    /**
     * @param Currency $source_currency
     * @param Currency $target_currency
     * @return CurrencyRate
     * @throws RateNotFoundException
     */
    public function get(Currency $source_currency, Currency $target_currency): CurrencyRate
    {
        $matched_rates = array_filter(
            $this->rates,
            function(CurrencyRate $rate) use ($target_currency, $source_currency) {
                return $rate->sourceCurrency()->code() === $source_currency->code()
                    && $rate->targetCurrency()->code() === $target_currency->code();
            }
        );

        $matched_rate = array_shift($matched_rates);

        if (!$matched_rate) {
            throw new RateNotFoundException($source_currency, $target_currency);
        }

        return $matched_rate;
    }
}