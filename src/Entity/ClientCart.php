<?php

namespace Project\Entity;

use Project\Entity\Exception\RemoveFromEmptyCartException;
use Project\Provider\CurrencyProvider;
use Project\Service\CurrencyService;

class ClientCart
{
    private int $id;
    private array $cart;

    public function __construct()
    {
        //random id generator for now.
        $this->id = rand(1,10000);
        $this->createCartStructure();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCart(): array
    {
        return $this->cart;
    }

    public function addProductToCart(Product $product): void
    {
        $key = $this->getProductKeyIfExists($product->getId());

        if (!is_null($key)) {
           $this->cart['products'][$key] = $product->toArray();
        } else {
            $this->cart['products'][] = $product->toArray();
        }

        $this->calculateTotalPrice();
    }

    public function removeProductFromCart(Product $product): void
    {
        $key = $this->getProductKeyIfExists($product->getId());

        if (!is_null($key)) {
            unset($this->cart['products'][$key]);
        } else {
            throw new RemoveFromEmptyCartException('The provided product to remove does not exist. Ignoring action');
        }

        $this->calculateTotalPrice();
    }

    public function getCartTotalSum()
    {
        return $this->cart['total_price'];
    }

    private function createCartStructure(): void
    {
        $this->cart = [
            'cart_id'     => $this->id,
            'products'    => [],
            'total_price' => 0,
        ];
    }


    private function getProductKeyIfExists(string $id): ?int
    {
        foreach ($this->cart['products'] as $key => $product) {
            if ($product['id'] === $id) {
                return $key;
            }
        }

        return null;
    }

    private function calculateTotalPrice(): void
    {
        $currencyService = new CurrencyService(new CurrencyProvider());
        $totalPrice = 0;

        foreach ($this->cart['products'] as $product) {
            $totalPrice += $currencyService->getConvertedPrice($product['price'], $product['currency']) * $product['quantity'];
        }

        $this->cart['total_price'] = $totalPrice;
    }


}