<?php

use App\Currency;
use App\CurrencyRate;
use App\CurrencyRateArrayRepository;
use App\CurrencyRateRepository;

require_once __DIR__ . '/../vendor/autoload.php';

class CurrencyRateRepositoryFactory
{
    public function create(): CurrencyRateRepository
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $http_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        return new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );
    }
}

$currency_repository = (new CurrencyRateRepositoryFactory())->create();

$source_currency = new Currency('USD');
$target_currency = new Currency('RUB');

if (!$currency_repository->has($source_currency, $target_currency)) {
    echo "Sorry there are no currency rate exists for {$source_currency->code()}-{$target_currency->code()} pair!";
} else {
    $rate = $currency_repository->get($source_currency, $target_currency);
    echo "Currency rate for {$source_currency->code()}-{$target_currency->code()} pair is: " . $rate->rate();
}
