<?php
require __DIR__ . '/vendor/autoload.php';
use Project\Manager\CartManager;
use Project\Service\CartService;

echo 'Welcome to the shopping cart' . PHP_EOL;
echo 'We are processing your orders' . PHP_EOL;
$manager = new CartManager(new CartService());
$manager->processProducts();

