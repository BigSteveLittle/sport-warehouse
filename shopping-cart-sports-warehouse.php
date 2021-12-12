<?php
    // Call the Item and ShoppingCart classes.
    require_once "classes/Item.php";
    require_once "classes/ShoppingCart.php";

    // Check if a session has already started. If not start one.
    if(!isset($_SESSION)) {
        session_start();
    }

    // Page identifier.
    $title = "Shopping Cart - Sports Warehouse";

    // Create the item object.
    $item = new Item();
    $message = "";

    // Retrieve all items that may be listed.
    $itemRows = $item->getItems();

    // Remove product from shopping cart.
    if(isset($_POST["remove"])) {
    // Check item id was supplied and cart exists in session.
        if(!empty($_POST["itemId"]) && isset($_SESSION["cart"])) {
            $itemId = $_POST["itemId"];
            // Create a new cart product so it can be removed from shopping cart.
            // The only value that is important is item Id.
            $product = new CartProduct("", 0, 0, $itemId);
            // Read shopping cart from session.
            $cart = $_SESSION["cart"];
            // Remove product from shopping cart.
            $cart->removeProduct($product);
            // Save shopping cart back into session.
            $_SESSION["cart"] = $cart;
        }
    }

    // Start buffer.
    ob_start();

    // Display shopping cart.
    include "templates/display-shopping-cart.html.php";

    // Output the contents of the buffer.
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>