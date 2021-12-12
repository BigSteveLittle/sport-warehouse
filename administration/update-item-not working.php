<?php
    require_once "./classes/CategoryAdmin.php";
    require_once "./classes/ItemAdmin.php";
    require_once "../classes/DBAccess.php";
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

    $title = "Update Items - Sports Warehouse";
    $pageHeading = "Update Items";

    // Call the protect method.
    AdminAuthentication::protect();

    // Display all the categories in a table. 
    $displayCategories = new CategoryAdmin();
    $categoryRows = $displayCategories->getCategories();

    //get database settings
    include "../settings/db-sportswh.php";
    //create database object
    $db = new DBAccess($dsn, $username, $password);

    // Create a new DBAccess object using the constructor method.
    $updateItem = new ItemAdmin();

    $message = "";
    $error = false;
    //update the item when the button is clicked
    if(isset($_POST["submit"]) && !empty($_POST["itemId"])) {
        $id = $updateItem->updateItem();
        $message = "The item was updated. id: " . $id;
        }
    //display the item to be updated
    //get the item id from the query string or from the posted data if the submit button was pressed
    if(isset($_GET["id"])) {
        $itemId = $_GET["id"];
    }
    elseif (isset($_POST["itemId"])) {
        $itemId = $_POST["itemId"];
    }
    else {
        $itemId = 0;
    }

    $itemRows = $updateItem->getItem($itemId);


    // Select all items to display in a table.
    $allItemsRows = $updateItem->getItems();

    //start buffer
    ob_start();
    
    //display form
    include "./templates/item-edit-form.html.php";
    // Display items.
    include "./templates/display-items.html.php";
    $output = ob_get_clean();
    include "./templates/layout.html.php";
?>