<?php

namespace Project\Entity;

class Product
{
    private string $id;
    private string $name;
    private int $quantity;
    private float $price;
    private string $currency;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function toArray(): array
    {
        return [
            'id'       => $this->getId(),
            'name'     => $this->getName(),
            'price'    => $this->getPrice(),
            'currency' => $this->getCurrency(),
            'quantity' => $this->getQuantity()
        ];
    }

    public function checkIfProductIsBeingAdded(): bool
    {
        return $this->getQuantity() > 0;
    }
}