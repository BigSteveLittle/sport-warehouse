<?php
    // Call the Item and ShoppingCart classes.
    require_once "classes/Item.php";
    require_once "classes/ShoppingCart.php";

    // Check if a session has already started. If not start one.
    if(!isset($_SESSION)) {
        session_start();
    }

    // Insert page title and heading. 
    $title = "Display Product - Sports Warehouse";

    // Create a new Item object.
    $singleItem = new Item();

    // Start the buffer. 
    ob_start();

    $row = "";

    // Add Product to shopping cart when 'Buy' button is pressed.
    if(isset($_POST["buy"])) {
        // Check item id and qty are not empty.
        if(!empty($_POST["itemId"]) && !empty($_POST["qty"])) {
            $itemId = $_POST["itemId"];
            $qty = $_POST["qty"];
            // Get the item details.
            $singleItem->getItem($itemId);
            // Create a new cart product so it can be added to the shopping cart.
            $product = new CartProduct($singleItem->getItemName(), $qty, $singleItem->getCartPrice($itemId), $itemId);
            // Check if shopping cart exists.
            if(!isset($_SESSION["cart"])) {
            // If shopping cart does not exist, create a new shopping cart.
            $cart = new ShoppingCart();
            }
            else {
            // Read shopping cart from session.
            $cart = $_SESSION["cart"];
            }
            // Add product to shopping cart.
            $cart->addProduct($product);
            // Save shopping cart back into session.
            $_SESSION["cart"] = $cart;
        }
    }
    // Get the product id via $_GET.
    if(isset($_GET["ID"])) {
        $itemId = $_GET["ID"];
        // Retrieve the single row using the getItem method of the Item class. 
        $itemRow = $singleItem->getItem($itemId);
    }
    // Get the product id via $_POST.
    else if(isset($_POST["itemId"])) {
        $itemId = $_POST["itemId"];
        // Retrieve the single row using the getItem method of the Item class. 
        $itemRow = $singleItem->getItem($itemId);
    }
    
    // Insert the product information display.
    include "templates/product-item.html.php";

    // Empty the buffer of the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>