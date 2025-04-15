<?php

use App\Product;
use App\RuntimeCartStorage;
use App\ShoppingCart;
use Behat\Behat\Context\Context;
use Behat\Step\Given;
use Behat\Step\Then;
use Behat\Step\When;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private ShoppingCart $shoppingCart;

    /** @var Product[] */
    private array $products = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->shoppingCart = new ShoppingCart(new RuntimeCartStorage());
    }

    #[Given('there is a :arg1, which costs :arg2')]
    public function thereIsAWhichCosts($arg1, $arg2): void
    {
        $this->products[$arg1] = new Product($arg1, $arg2);
    }

    #[When('add :arg1 to cart')]
    public function addToCart($arg1): void
    {
        $this->shoppingCart->addToCart($this->products[$arg1]);
    }

    #[Then(':arg1 should be in cart')]
    public function shouldBeInCart($arg1): void
    {
        assertContains($this->products[$arg1], $this->shoppingCart->showCart());
    }

    #[Then('total should be equal :arg')]
    public function totalShouldBeEqual($arg1): void
    {
        assertEquals($arg1, $this->shoppingCart->getTotalPrice());
    }
}
