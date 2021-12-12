<?php
    // Call the Item class.
    require_once "classes/Item.php";

    // Insert page title and heading. 
    $title = "Search Results - Sports Warehouse";

    // Start the buffer. 
    ob_start();
    
    // Create a new Item object.
    $item = new Item();
    
    // Check if the search button is pressed by the user. 
    if(isset($_GET["submitBtn"]) && isset($_GET["search"])) {
        // Invoke the 'searchItems' method of class 'Item.php'. 
        $itemRows = $item->searchItems();
        // Insert the categories display.
        include "templates/search-results.html.php";
    }
    
    // Empty the buffer of the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>