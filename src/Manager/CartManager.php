<?php

namespace Project\Manager;

use Project\DataTransformer\CsvToArrayTransformer;
use Project\Factory\ProductFactory;
use Project\Service\CartServiceInterface;

class CartManager extends AbstractManager
{
    private CartServiceInterface $cartService;
    private ProductFactory $productFactory;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
        $this->productFactory = new ProductFactory();
    }

    public function processProducts(): void
    {
        $data = CsvToArrayTransformer::transformFileToArray();

        foreach ($data as $entry) {
            try {
                $product = $this->productFactory->create($entry);

                if ($product->checkIfProductIsBeingAdded()) {
                    $this->cartService->addToCart($product);
                } else {
                    $this->cartService->removeFromCart($product);
                }

                print_r($this->cartService->getClientCartTotal());
            } catch (\Exception $exception) {
                print_r($exception->getMessage() . PHP_EOL);
                continue;
            }
        }

        print_r($this->cartService->saveCart());
    }
}