<?php

namespace App;

class RuntimeCartStorage implements CartStorageInterface
{
    private array $products = [];

    /**
     * @inheritDoc
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function unsetProduct(Product $product): void
    {
        $this->products = array_filter($this->products, function (Product $pr) use ($product) {
            return $pr !== $product;
        });
    }
}