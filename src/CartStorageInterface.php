<?php

namespace App;

interface CartStorageInterface
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;

    public function addProduct(Product $product): void;

    public function unsetProduct(Product $product): void;
}