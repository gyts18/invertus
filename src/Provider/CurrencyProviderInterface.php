<?php

namespace Project\Provider;

interface CurrencyProviderInterface
{
    public function getConvertedValue(string $currency): float;
    public function checkIfCurrencyIsAvailable(string $currency): bool;
}