<?php
    // Call the required classes.
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
    $title = "Delete Items - Sports Warehouse";
    $pageHeading = "Delete Items";

    // Call the protect method.
    AdminAuthentication::protect();

    $deleteItems = new ItemAdmin();

    // Assign initial values for variables. 
    $message = "";

    // Get the itemID to delete. 
    if(!empty($_GET["id"])) {
        $deleteItems->deleteItem();

        // Success message. 
        $message = "The item was deleted.";
    }
    // Display all the items in a table. 
    $displayItems = new ItemAdmin();
    $itemRows = $displayItems->getItems();

    // Start the buffer. 
    ob_start();

    // Insert the item entry form.
    include "./templates/display-items.html.php";

    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "./templates/layout.html.php";
?>