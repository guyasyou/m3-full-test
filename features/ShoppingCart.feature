Feature: ShoppingCart
  Scenario:
    Given there is a "Product 1", which costs "10"
    When add "Product 1" to cart
    Then "Product 1" should be in cart
  Scenario:
    Given there is a "Product 1", which costs "10"
    Given there is a "Product 2", which costs "15"
    When add "Product 1" to cart
    When add "Product 2" to cart
    Then "Product 1" should be in cart
    Then "Product 2" should be in cart
  Scenario:
    Given there is a "Product 1", which costs "10"
    Given there is a "Product 2", which costs "25"
    When add "Product 1" to cart
    When add "Product 2" to cart
    Then total should be equal "35"