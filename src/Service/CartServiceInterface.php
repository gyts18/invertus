<?php

namespace Project\Service;

use Project\Entity\Product;

interface CartServiceInterface
{
    public function addToCart(Product $product);
    public function removeFromCart(Product $product);
    public function getClientCartTotal(): void;
    public function saveCart(): void;
}