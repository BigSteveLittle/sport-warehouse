<?php
    // Call the Item and Category classes.
    require_once "classes/Item.php";
    require_once "classes/Category.php";

    // Insert page title and heading. 
    $title = "Items by Category - Sports Warehouse";

    // Create a new object from the Item and Category classes.
    $item = new Item();
    $category = new Category();

    $categoryName = "";
    $itemRows = "";
    
    if(isset($_GET["categoryId"])) {
        $itemCategoryId = $_GET["categoryId"];
        // Retrieve all categories using the getCategories method. 
        $itemRows = $item->getItemsByCategoryId($itemCategoryId);
        $categoryName = $category->getCategory($itemCategoryId); 
        // Start the buffer. 
        ob_start();
        // Insert the items by category display.
        include "templates/items-by-category.html.php";

    }
    
    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>