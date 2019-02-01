<?php
namespace App\Contract;

use App\Currency;
use App\CurrencyRate;

interface CurrencyRateReadonlyRepository
{
    public function get(Currency $source_currency, Currency $target_currency): CurrencyRate;
    public function has(Currency $source_currency, Currency $target_currency): bool;
}