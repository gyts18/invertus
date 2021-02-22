<?php

namespace Project\Provider;

class CurrencyProvider implements CurrencyProviderInterface
{
    /**
     * In real world scenarios there would be two possible ways:
     * 1. Calling directly to a 3rd party API via guzzle or SDK to get the correct currency values
     * 2. Even better have a CRON task, to check for any changes in the past 6-24 hours (currencies rarely fluctate drastically, so it's safe not to check so often)
     * and to insert them into any database.
     *
     * Additionally, there should be an formatter, which should extend some kind of formatter interface so that the response would always be the same
     * if more currency providers would exist.
     *
     * For this, i'll just leave defined hardcode type of way.
     *
     */

    public const DEFAULT_CURRENCY = 'EUR';
    public const CURRENCIES = [
        'USD' => 1.14,
        'GBP' => 0.88
    ];

    public function getConvertedValue(string $currency): float
    {
        return self::CURRENCIES[$currency];
    }

    public function checkIfCurrencyIsAvailable(string $currency): bool
    {
        if (array_key_exists($currency, self::CURRENCIES) || $currency === self::DEFAULT_CURRENCY) {
            return true;
        }

        return false;
    }
}