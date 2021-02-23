<?php

namespace Project\Factory;

use Project\Entity\Product;
use Project\Factory\Exception\MissingFieldException;
use Project\Factory\Exception\NonEnabledCurrencyException;
use Project\Provider\CurrencyProvider;
use Project\Service\CurrencyService;

class ProductFactory
{
    private const REQUIRED_FIELDS = [
        'id'       => true,
        'name'     => true,
        'currency' => false,
        'price'    => false,
        'quantity' => true,
    ];

    public function create(array $data): Product
    {
        $this->validateData($data);

        $product = new Product();
        $product->setId($data['id']);
        $product->setName($data['name']);
        $product->setCurrency($data['currency']);
        $product->setPrice((float)$data['price']);
        $product->setQuantity((int)$data['quantity']);

        return $product;
    }

    private function validateData(array $data): void
    {
        foreach ($data as $key => $datum) {
            // 0 quantity counts too, which makes sense
            if (self::REQUIRED_FIELDS[$key] === true && empty($datum)) {
                throw new MissingFieldException('The field: ' . $key . ' is required, but is missing, skipping the add to cart process');
            }

            if (($key === 'currency' && !empty($datum)) && !$this->checkIfCurrencyIsAvailable($datum)) {
                throw new NonEnabledCurrencyException('The provided currency: ' . $datum . ' is not enabled by the system, skipping the product add to cart process');
            }
        }
    }

    private function checkIfCurrencyIsAvailable(string $currency): bool
    {
        return (new CurrencyService(new CurrencyProvider()))->checkIfCurrencyIsAvailable($currency);
    }
}