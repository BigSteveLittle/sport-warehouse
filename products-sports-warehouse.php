<?php
    // Call the Item class.
    require_once "classes/Item.php";

    // Insert page title and heading. 
    $title = "View Products - Sports Warehouse";

    // Create a new Item object.
    $item = new Item();

    // Retrieve all items. 
    $itemRows = $item->getItemsSort(); 

    // Start the buffer. 
    ob_start();

    // Insert the products display.
    include "templates/display-items-sort.html.php";

    // Empty the buffer from the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "header-footer.php";
?>