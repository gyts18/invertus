<?php

namespace Project\Service;

use Project\Provider\CurrencyProvider;
use Project\Provider\CurrencyProviderInterface;

class CurrencyService
{
    private CurrencyProviderInterface $currencyProvider;

    public function __construct(CurrencyProviderInterface $currencyProvider)
    {
        $this->currencyProvider = $currencyProvider;
    }

    public function getConvertedPrice(float $price, string $currency): float
    {
        if ($currency === CurrencyProvider::DEFAULT_CURRENCY) {
            return $price;
        }

        $convertedValue = $this->currencyProvider->getConvertedValue($currency);

        if ($convertedValue <= 1) {
            return round($price / $convertedValue, 2);
        }

        return round($price * $convertedValue, 2);
    }

    public function checkIfCurrencyIsAvailable(string $currency): bool
    {
        return $this->currencyProvider->checkIfCurrencyIsAvailable($currency);
    }
}