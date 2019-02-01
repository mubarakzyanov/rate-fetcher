<?php

namespace App;

use App\Contract\CurrencyRateReadonlyRepository;
use App\Contract\CurrencyRateRepository as CurrencyRateRepositoryContract;

class CurrencyRateRepository implements CurrencyRateReadonlyRepository
{
    /**
     * @var CurrencyRateRepositoryContract
     */
    private $cache_repository;

    /**
     * @var CurrencyRateRepositoryContract
     */
    private $database_repository;

    /**
     * @var CurrencyRateReadonlyRepository
     */
    private $http_repository;

    public function __construct(
        CurrencyRateRepositoryContract $cache_repository,
        CurrencyRateRepositoryContract $database_repository,
        CurrencyRateReadonlyRepository $http_repository
    ) {
        $this->cache_repository = $cache_repository;
        $this->database_repository = $database_repository;
        $this->http_repository = $http_repository;
    }

    public function get(Currency $source_currency, Currency $target_currency): CurrencyRate
    {
        if ($this->cache_repository->has($source_currency, $target_currency)) {
            $rate = $this->cache_repository->get($source_currency, $target_currency);
        } elseif ($this->database_repository->has($source_currency, $target_currency)) {
            $rate = $this->database_repository->get($source_currency, $target_currency);
            $this->cache_repository->add($rate);
        } else {
            $rate = $this->http_repository->get($source_currency, $target_currency);
            $this->database_repository->add($rate);
            $this->cache_repository->add($rate);
        }

        return $rate;
    }

    public function has(Currency $source_currency, Currency $target_currency): bool
    {
        return
            $this->cache_repository->has($source_currency, $target_currency) ||
            $this->database_repository->has($source_currency, $target_currency) ||
            $this->http_repository->has($source_currency, $target_currency);
    }
}