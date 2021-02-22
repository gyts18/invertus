<?php

namespace Project\Manager;

use Project\DataTransformer\CsvToArrayTransformer;
use Project\Factory\ProductFactory;
use Project\Service\CartServiceInterface;

class CartManager extends AbstractManager
{
    private $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function processProducts()
    {
        $data = CsvToArrayTransformer::transformFileToArray();
        $productFactory = new ProductFactory();

        foreach ($data as $entry) {
            try {
                $product = $productFactory->create($entry);

                if ($product->checkIfProductIsBeingAdded()) {
                    $this->cartService->addToCart($product);
                } else {
                    $this->cartService->removeFromCart($product);
                }

                $this->cartService->getClientCartTotal();
            } catch (\Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
                continue;
            }
        }

        $this->cartService->saveCart();
    }
}