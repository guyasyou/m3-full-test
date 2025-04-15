<?php


namespace Tests\Unit\App;

use App\Product;
use App\RuntimeCartStorage;
use App\ShoppingCart;
use Codeception\Stub;
use Codeception\Test\Unit;
use Exception;
use Tests\Support\UnitTester;

class ShoppingCartTest extends Unit
{

    protected UnitTester $tester;

    /**
     * @throws Exception
     */
    protected function _before(): void
    {
    }

    public function testAddingToCart()
    {
        $product = new Product('qwe', 123);

        $cartStorage = Stub::make(RuntimeCartStorage::class, ['addProduct' => function (Product $param) use ($product) {
            $this->assertEquals($product, $param);
        }], $this);

        $shoppingCart = new ShoppingCart($cartStorage);
        $shoppingCart->addToCart($product);
    }

    public function testReturnsProductsFromCart()
    {
        $product1 = new Product('qwe', 123);
        $product2 = new Product('asd', 456);
        $product3 = new Product('zxc', 789);

        $cartStorage = Stub::make(RuntimeCartStorage::class, ['getProducts' => [$product1, $product2, $product3]], $this);

        $shoppingCart = new ShoppingCart($cartStorage);
        $this->assertEquals([$product1, $product2, $product3], $shoppingCart->showCart());
    }

    public function testTotalOfCart()
    {
        $product1 = new Product('qwe', 123);
        $product2 = new Product('asd', 456);
        $product3 = new Product('zxc', 789);

        $cartStorage = Stub::make(RuntimeCartStorage::class, ['getProducts' => [$product1, $product2, $product3]], $this);

        $shoppingCart = new ShoppingCart($cartStorage);
        $this->assertEquals(123 + 456 + 789, $shoppingCart->getTotalPrice());
    }
}
