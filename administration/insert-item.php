<?php
    // Call the DBAccess class.
    require_once "./classes/CategoryAdmin.php";
    require_once "./classes/ItemAdmin.php";
    require_once "./classes/AdminAuthentication.php";

    // Begin a SESSION.
    session_start();

    // Read stylesheet theme from session. 
    if(isset($_SESSION["theme"])) {
        $theme = $_SESSION["theme"] . ".css";
    }
    else {
        $theme = "styles.css";
    }

    if(!isset($_SESSION)) {
        session_start();
    }

    // Insert page title and heading. 
    $title = "Insert Item - Sports Warehouse";
    $pageHeading = "Insert Item";

    // Call the protect method.
    AdminAuthentication::protect();

    // Display all the categories in a table. 
    $displayCategories = new CategoryAdmin();
    $categoryRows = $displayCategories->getCategories();

    // Create a new DBAccess object using the constructor method.
    $addItem = new ItemAdmin();

    // Assign an initial value for $message.
    $message = "";
    
    // Check if the button was pressed by the user.
    if(isset($_POST["submit"])) {
        // Check if a item name has been supplied by the user.
        if(!empty($_POST["itemName"])) {
            $id = $addItem->insertNewItem();
            $message = "The item was added. id: " . $id;
        }
    }
    ob_start();
    // Insert the item entry form.
    include "./templates/item-insert-form.html.php";

    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "./templates/layout.html.php";
?>