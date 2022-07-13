<?php

namespace Src\cart;

use Countable;

final class Basket implements Countable
{
    private Shelf $shelf;
    private array $products = [];
    private float $productsPrice = 0.0;

    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    public function addProduct($product): void
    {
        $this->products[] = $product;
        $this->addProductPrice($product);
    }

    public function getTotalPrice(): float
    {
        return $this->productsPrice
            + $this->getVat()
            + $this->getShippingCost();
    }

    public function count(): int
    {
        return count($this->products);
    }

    private function addProductPrice(string $product): void
    {
        $this->productsPrice += $this->shelf->getProductPrice($product);
    }

    private function getVat(): float
    {
        return $this->productsPrice * 0.2;
    }

    private function getShippingCost(): float
    {
        return $this->productsPrice > 10 ? 2.0 : 3.0;
    }
}