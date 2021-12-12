<?php
    // Call the Item class.
    require_once "classes/Item.php";

    // No page title required. 

    // Create a new DBAccess object.
    $item = new Item();

    $itemRows = "";

    // Retrieve all categories using the getCategories method. 
    $itemRows = $item->getFeaturedItems();

    // Buffer storage not used. 

    // Insert the featured products feed.
    include "templates/featured-products.html.php";

    // Buffer $output not used. 

    // No HTML layout required. 

?>