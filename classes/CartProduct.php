<?php
// CART Product CLASS

// A class to represent details of an Product for adding to the shopping cart.

// Class Map.

// - _productName
// - _quantity
// - _price
// - _productId

// 1. -- __construct($productName, $quantity, $price, $productId) (assign properties to variables).
// 2. + getQuantity() (get the quantity of an product).
// 3. + setQuantity($value) (set the initial quantity value).
// 4. + getPrice() (get the product price).
// 5. + getProductId() (get the productId).
// 6. + getProductName() (get the productName).

// Create class.
class CartProduct {
    // Properties.
    private $_productName;
    private $_quantity;
    private $_price;
    private $_productId;

    // 1. A constructor method to assign the properties to variables.
    public function __construct($productName, $quantity, $price, $productId) {
        $this->_productName = $productName;
        $this->_quantity = $quantity;
        $this->_price = $price;
        $this->_productId = $productId;
    }
    // 2. A method to get the quantity of an product.
    public function getQuantity() {
        return $this->_quantity;
    }
    // 3. A method to set the initial quantity value.
    public function setQuantity($value) {
        if($value >= 0) {
            $this->_quantity = (int)$value;
        }
        else {
            throw new Exception("Dude, the quantity has to at least be positive.");
        }
    }
    // 4. A method to get the product price.
    public function getPrice() {
        return $this->_price;
    }
    // 5. A method to get the productId.
    public function getProductId() {
        return $this->_productId;
    }
    // 6. A method to get the productName.
    public function getProductName() {
        return $this->_productName;
    }
}
?>