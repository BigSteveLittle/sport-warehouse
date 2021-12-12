<?php
// SHOPPING CART CLASS

// A class to represent details of an Product for adding to the shopping cart.

// Class Map.

// - _cartProducts.
// - _shoppingOrderId.

// 1. + count() (for total count).
// 2. + setShoppingOrderID($id) (set the order id).
// 3. + getProducts() (get all products).
// 4. + addProduct() (add product to cart).
// 5. + updateProduct($cartProduct) (update changes to products in the cart).
// 6. + removeProduct($cartProduct) (remove an product from the cart). 
// 7. + calculateTotal() (calculate total value of cart). 
// 8. + saveCart($Address, $ContactNumber, $CreditCardNumber, $CSV, $Email, $ExpiryDate, $FirstName, $LastName, $NameOnCard) (save cart and personal details in case of interruption). 
// 9. + inCart($cartProduct) (check cart contents after interruption). 
// 10. + productIndex($cartProduct) (calculate the total number of an product). 
// 11. + displayArray() (display the array testing). 

// Call other classes.
require_once "classes/CartProduct.php";
require_once "classes/DBAccess.php";
// Create class.
class ShoppingCart {
    // Properties.
    private $_cartProducts = [];
    private $_shoppingOrderId;

    // 1. A method for total count.
    public function count() {
        return count($this->_cartProducts);
    }
    // 2. Method to set the order id.
    public function setShoppingOrderID($id) {
        $this->_shoppingOrderId = (int)$id;
    }
    // 3. Method to get all products.
    public function getProducts() {
        return $this->_cartProducts;
    }
    // 4. Method to add product to cart.
    public function addProduct($cartProduct) {
        // If cart already exists update the quantity.
        $found = $this->inCart($cartProduct);
        if($found != null) {
            // Update quantity. 
            $this->updateProduct($cartProduct);
        }
        else {
            // Insert new cart.
            $this->_cartProducts[] = $cartProduct;
        }
    }
    // 5. Method to update an product.
    public function updateProduct($cartProduct) {
        $index = $this->productIndex($cartProduct);
        // Get current quantity.
        $oldQty = $this->_cartProducts[$index]->getQuantity();
        $additionalQty = $cartProduct->getQuantity();
        // Calculate new quantity. 
        $newQty = $oldQty + $additionalQty;
        // Update cart product with new quantity.
        $this->_cartProducts[$index]->setQuantity($newQty);
    }
    // 6. Method to remove an product.
    public function removeProduct($cartProduct) {
        $index = $this->productIndex($cartProduct);
        if($index >= 0) {
            // Remove array.
            unset($this->_cartProducts["$index"]);
            // Reorganise values.
            $this->_cartProducts = array_values($this->_cartProducts);
        }
    }
    // 7. Method to calculate the total.
    public function calculateTotal() {
        $total = 0.0;
        foreach($this->_cartProducts as $product) {
            $total += $product->getQuantity() * $product->getPrice();
        }
        return $total;
    }
    // 8. Method to commit the cart and any personal details to the database for final order.
    public function saveCart($address, $contactNumber, $creditCardNumber, $csv, $email, $expiryDate, $firstName, $lastName, $nameOnCard) {
        // DB setup and connect.
        include "settings/db-sportswh.php";
        $db = new DBAccess($dsn, $username, $password);
        $pdo = $db->connect();
        // Set up SQL statement to insert order.
        $sql = "INSERT INTO 
                    shoppingorder(
                        address, 
                        contactNumber, 
                        creditCardNumber, 
                        csv, 
                        email, 
                        expiryDate, 
                        firstName, 
                        lastName, 
                        nameOnCard, 
                        orderDate)
                    VALUES(
                        :address, 
                        :contactNumber, 
                        :creditCardNumber, 
                        :csv, 
                        :email, 
                        :expiryDate, 
                        :firstName, 
                        :lastName, 
                        :nameOnCard, 
                        CURDATE())";
        // Prepare and bind values.
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":address" , $address, PDO::PARAM_STR);
        $stmt->bindValue(":contactNumber" , $contactNumber, PDO::PARAM_STR);
        $stmt->bindValue(":creditCardNumber" , $creditCardNumber, PDO::PARAM_STR);
        $stmt->bindValue(":csv" , $csv, PDO::PARAM_STR);
        $stmt->bindValue(":email" , $email, PDO::PARAM_STR);
        $stmt->bindValue(":expiryDate" , $expiryDate, PDO::PARAM_STR);
        $stmt->bindValue(":firstName" , $firstName, PDO::PARAM_STR);
        $stmt->bindValue(":lastName" , $lastName, PDO::PARAM_STR);
        $stmt->bindValue(":nameOnCard" , $nameOnCard, PDO::PARAM_STR);
        // Execute query.
        $shoppingOrderId = $db->executeReadWrite($stmt, true);
        // Loop through shopping cart and insert products.
        foreach($this->_cartProducts as $product) {
            // Set up the insert statement. 
            $sql = "INSERT INTO 
                        orderitem(
                            itemId, 
                            Price, 
                            Quantity, 
                            shoppingOrderId) 
                        VALUES(
                            :itemId, 
                            :price, 
                            :quantity, 
                            :shoppingOrderId)";
            // For each product insert a row in Orderproduct.
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":itemId" , $product->getProductId(), PDO::PARAM_INT);
            $stmt->bindValue(":price" , $product->getPrice(), PDO::PARAM_STR);
            $stmt->bindValue(":quantity" , $product->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(":shoppingOrderId" , $shoppingOrderId, PDO::PARAM_INT);
            // Execute query.
            $db->executeReadWrite($stmt);
        }
        return $shoppingOrderId;
    }
    // 9. Method to check cart contents after interruption.
    private function inCart($cartProduct) {
        $found = null;

        foreach($this->_cartProducts as $product) {
            if ($product->getProductId() == $cartProduct->getProductId()) {
                $found = $product;
            }
        }
        return $found;
    }
    // 10. Method to calculate the total number of an product.
    private function productIndex($cartProduct) {
        $index = -1;
        for($i=0; $i<$this->count(); $i++) {
            if($cartProduct->getProductId() == $this->_cartProducts[$i]->getProductId()) {
                $index = $i;
                }
        }
        return $index;
    }
    // 11. Method to display an array for testing.
    public function displayArray() {
        print_r($this->_cartProducts);
    }
}
?>