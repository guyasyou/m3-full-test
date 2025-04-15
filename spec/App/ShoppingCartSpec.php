<?php

namespace spec\App;

use App\CartStorageInterface;
use App\Product;
use PhpSpec\ObjectBehavior;

class ShoppingCartSpec extends ObjectBehavior
{
    public function it_should_add_item(CartStorageInterface $cartStorage): void
    {
        $cartStorage->beADoubleOf(CartStorageInterface::class);
        $this->beConstructedWith($cartStorage);

        $product = new Product('qwe', 123);
        $cartStorage->addProduct($product)->shouldBeCalledTimes(1);
        $this->addToCart($product);
    }

    public function it_should_return_items(CartStorageInterface $cartStorage): void
    {
        $cartStorage->beADoubleOf(CartStorageInterface::class);
        $this->beConstructedWith($cartStorage);

        $product1 = new Product('qwe', 123);
        $product2 = new Product('asd', 456);
        $product3 = new Product('zxc', 789);
        $cartStorage->getProducts()->willReturn([$product1, $product2, $product3]);
        $this->showCart()->shouldEqual([$product1, $product2, $product3]);
    }

    public function it_should_return_correct_total(CartStorageInterface $cartStorage): void
    {
        $cartStorage->beADoubleOf(CartStorageInterface::class);
        $this->beConstructedWith($cartStorage);

        $product1 = new Product('qwe', 123);
        $product2 = new Product('asd', 456);
        $product3 = new Product('zxc', 789);
        $cartStorage->getProducts()->willReturn([$product1, $product2, $product3]);

        $this->getTotalPrice()->shouldEqual(123 + 456 + 789);
    }
}
