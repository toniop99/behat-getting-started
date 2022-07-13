<?php

namespace Src\cart;


final class Shelf
{
    private array $priceMap = [];

    public function setProductPrice(string $product, int $price): void
    {
        $this->priceMap[$product] = $price;
    }

    public function getProductPrice(string $product)
    {
        return $this->priceMap[$product];
    }
}