<?php

namespace App;

readonly class ShoppingCart
{
    public function __construct(
        private CartStorageInterface $cartStorage,
    )
    {
    }

    /**
     * @return Product[]
     */
    public function showCart(): array
    {
        return $this->cartStorage->getProducts();
    }

    public function addToCart(Product $product): void
    {
        $this->cartStorage->addProduct($product);
    }

    public function removeFromCart(Product $product): void
    {
        $this->cartStorage->unsetProduct($product);
    }

    public function clearCart(Product $product): void
    {
        foreach ($this->cartStorage->getProducts() as $product) {
            $this->cartStorage->unsetProduct($product);
        }
    }

    public function getTotalPrice(): int
    {
        $total = 0;
        foreach ($this->cartStorage->getProducts() as $product) {
            $total = $total + $product->getPrice();
        }
        return $total;
    }
}