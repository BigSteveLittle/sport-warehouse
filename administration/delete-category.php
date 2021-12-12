<?php
    // Call the required classes.
    require_once "./classes/CategoryAdmin.php";
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
    $title = "Delete Categories - Sports Warehouse";
    $pageHeading = "Delete Categories";

    // Call the protect method.
    AdminAuthentication::protect();

    $deleteCategories = new CategoryAdmin();

    // Assign initial values for variables. 
    $message = "";

    // Get the CategoryID to delete. 
    if(!empty($_GET["id"])) {
        $deleteCategories->deleteCategory();

        // Success message. 
        $message = "The category was deleted.";
    }
    // Display all the categories in a table. 
    $displayCategories = new CategoryAdmin();
    $categoryRows = $displayCategories->getCategories();

    // Start the buffer. 
    ob_start();

    // Insert the category entry form.
    include "./templates/display-categories.html.php";

    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "./templates/layout.html.php";
?>