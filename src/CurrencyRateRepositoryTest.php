<?php
namespace App;

use PHPUnit\Framework\TestCase;

class CurrencyRateRepositoryTest extends TestCase
{
    public function testHasCacheEmptyDatabaseEmptyRemoteEmpty()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $this->assertFalse($rate_repository->has(new Currency('USD'), new Currency('RUB')));
    }

    public function testHasCacheEmptyDatabaseEmptyRemoteExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $http_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertTrue($rate_repository->has(new Currency('USD'), new Currency('RUB')));
    }

    public function testHasCacheEmptyDatabaseExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $database_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertTrue($rate_repository->has(new Currency('USD'), new Currency('RUB')));
    }

    public function testHasCacheExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $cache_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertTrue($rate_repository->has(new Currency('USD'), new Currency('RUB')));
    }

    public function testGetCacheEmptyDatabaseEmptyRemoteEmpty()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $this->expectException(RateNotFoundException::class);

        $rate_repository->get(new Currency('USD'), new Currency('RUB'));
    }

    public function testGetCacheEmptyDatabaseEmptyRemoteExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $http_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertNotEmpty($rate_repository->get(new Currency('USD'), new Currency('RUB')));
        $this->assertNotEmpty($database_repository->get(new Currency('USD'), new Currency('RUB')));
        $this->assertNotEmpty($cache_repository->get(new Currency('USD'), new Currency('RUB')));
    }

    public function testGetCacheEmptyDatabaseExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $database_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertNotEmpty($rate_repository->get(new Currency('USD'), new Currency('RUB')));
        $this->assertNotEmpty($cache_repository->get(new Currency('USD'), new Currency('RUB')));
    }

    public function testGetCacheExists()
    {
        $cache_repository = new CurrencyRateArrayRepository();

        $database_repository = new CurrencyRateArrayRepository();

        $http_repository = new CurrencyRateArrayRepository();

        $rate_repository = new CurrencyRateRepository(
            $cache_repository,
            $database_repository,
            $http_repository
        );

        $cache_repository->add(new CurrencyRate(
            new Currency('USD'),
            new Currency('RUB'),
            '65.57'
        ));

        $this->assertTrue($rate_repository->has(new Currency('USD'), new Currency('RUB')));
    }
}
