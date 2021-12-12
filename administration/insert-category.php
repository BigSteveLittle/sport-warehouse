<?php
    // Call the DBAccess class.
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
    $title = "Insert Category - Sports Warehouse";
    $pageHeading = "Insert Category";

    // Call the protect method.
    AdminAuthentication::protect();

    // Create a new DBAccess object using the constructor method.
    $addCategory = new CategoryAdmin();

    // Assign an initial value for $message.
    $message = "";
    
    // Check if the button was pressed by the user.
    if(isset($_POST["submit"])) {
        // Check if a category name has been supplied by the user.
        if(!empty($_POST["categoryName"])) {
            $id = $addCategory->insertNewCategory();
            $message = "The category was added. id: " . $id;
        }
    }
    ob_start();
    // Insert the category entry form.
    include "./templates/category-insert-form.html.php";

    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "./templates/layout.html.php";
?>