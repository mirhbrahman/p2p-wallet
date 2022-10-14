<?php

namespace App\Services\Interfaces;

interface ExchangeApiInterface
{
    public function exchange(string $from_currency, string $to_currency, float $amount): float;
}
