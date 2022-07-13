<?php

namespace Tests\bootstrap;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\TestCase;
use Src\cart\Basket;
use Src\cart\Shelf;

class BasketContext extends TestCase implements Context
{
    private Shelf $shelf;
    private Basket $basket;

    public function __construct()
    {
        parent::__construct();
        $this->shelf  = new Shelf();
        $this->basket = new Basket($this->shelf);
    }

    /**
     * @Given there is a :product, which costs £:price
     */

    public function thereIsAWhichCostsPs($product, $price): void
    {
        $this->shelf->setProductPrice($product, $price);
    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheToTheBasket($product): void
    {
        $this->basket->addProduct($product);
    }

    /**
     * @Then I should have :count product(s) in the basket
     */
    public function iShouldHaveProductsInTheBasket($count): void
    {
        $this->assertCount((int) $count, $this->basket);
    }

    /**
     * @Then the overall basket price should be £:price
     */
    public function theOverallBasketPriceShouldBePs($price): void
    {
        $this->assertSame((float) $price, $this->basket->getTotalPrice());
    }
}
