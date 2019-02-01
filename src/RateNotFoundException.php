<?php

namespace App;

use Exception;
use Throwable;

class RateNotFoundException extends Exception
{
    public function __construct(
        Currency $source_currency,
        Currency $target_currency,
        int $code = 0,
        Throwable $previous = null
    ) {
        $message = "Sorry there are no currency rate exists for {$source_currency->code()}-{$target_currency->code()} pair!";
        parent::__construct($message, $code, $previous);
    }

}