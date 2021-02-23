<?php

namespace Project\Service;

use Project\Client\Exception\ClientConnectionException;
use Project\Client\RedisClient;
use Project\Entity\ClientCart;
use Project\Entity\Product;
use Project\Provider\CurrencyProvider;

class CartService implements CartServiceInterface
{
    private ClientCart $clientCart;

    public function __construct()
    {
        $this->clientCart = new ClientCart();
    }

    public function addToCart(Product $product)
    {
        $this->clientCart->addProductToCart($product);
    }

    public function removeFromCart(Product $product)
    {
        $this->clientCart->removeProductFromCart($product);
    }

    public function getClientCartTotal(): string
    {
        return 'Cart price is: ' . $this->clientCart->getCartTotalSum() . CurrencyProvider::DEFAULT_CURRENCY . PHP_EOL;
    }

    public function saveCart(): string
    {
        $cacheClient = new RedisClient();

        if (!$cacheClient->checkAvailability()) {
            throw new ClientConnectionException('Cache is offline or unavailable, unable to save cart data');
        }

        $cacheClient->save($this->clientCart->getId(), $this->clientCart->getCart());

        return 'Cart successfully saved, the cached result is: ' . $cacheClient->getByKey($this->clientCart->getId()) . PHP_EOL;
    }
}