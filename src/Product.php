<?php

namespace App;

class Product
{
    public function __construct(
        private readonly string $name,
        private readonly int    $price,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}