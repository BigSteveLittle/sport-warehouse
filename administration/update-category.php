<?php
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

    $title = "Update Categories - Sports Warehouse";
    $pageHeading = "Update Categories";

    // Call the protect method.
    AdminAuthentication::protect();

    //get database settings
    include "../settings/db-sportswh.php";
    //create database object
    $db = new DBAccess($dsn, $username, $password);
    //connect to database
    $pdo = $db->connect();
    $message = "";
    //update the category when the button is clicked
    if(isset($_POST["submit"])) {
        //check a category name and id was supplied
        if(!empty($_POST["categoryName"]) && !empty($_POST["categoryId"])) {
            //set up query to execute
            $sql = "update category set categoryName=:categoryName where categoryId = :categoryId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":categoryName" , $_POST["categoryName"], PDO::PARAM_STR);
            $stmt->bindValue(":categoryId" , $_POST["categoryId"], PDO::PARAM_INT);
            //execute SQL query
            $db->executeReadWrite($stmt, false);
            $message = "The category was updated";
        }
    }
    //display the category to be updated
    //get the category id from the query string or from the posted data if the submit button was pressed
    if(isset($_GET["id"])) {
        $catId = $_GET["id"];
    }
    elseif (isset($_POST["categoryId"])) {
        $catId = $_POST["categoryId"];
    }
    else {
        $catId = 0;
    }

    $sql = "select categoryId, categoryName from category where categoryID = :categoryId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":categoryId" , $catId, PDO::PARAM_INT);
    $rows = $db->executeSQL($stmt);




    // Select all categories to display in a table.
    $sql = "select categoryId, categoryName from category";
    $stmt = $pdo->prepare($sql);
    $categoryRows = $db->executeSQL($stmt);
    //start buffer
    ob_start();
    
    // Display categories.
    include "./templates/display-categories.html.php";
    //display form
    include "./templates/category-edit-form.html.php";
    $output = ob_get_clean();
    include "./templates/layout.html.php";
?>