<?php
    // Call the Category class.
    require_once "classes/Category.php";

    // No page title required. 

    // Create a new Category object.
    $category = new Category();

    // Buffer storage not used. 

    // Retrieve all categories using the getCategories method. 
    $categoryRows = $category->getCategories();

    // Insert the employees display.
    include "templates/footer-categories-menu.html.php";

    // Retrieve the categoriesId. 
    $categoryRows = $category->getCategory($categoryId); 

    // Buffer $output not used. 

    // No HTML layout required.  
    
?>