<?php
namespace App\Contract;

use App\CurrencyRate;

interface CurrencyRateRepository extends CurrencyRateReadonlyRepository
{
    public function add(CurrencyRate $rate);
}