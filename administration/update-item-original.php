<?php
    require_once "./classes/CategoryAdmin.php";
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
    //connect to database
    $pdo = $db->connect();
    $message = "";
    $error = false;
    //update the item when the button is clicked
    if(isset($_POST["submit"]) && !empty($_POST["itemId"])) {
        
        //specify directory where image will be saved
        $targetDirectory = "../images/products/";
        //get the filename
        $photo = basename($_FILES["photo"]["name"]);
        //set the entire path
        $targetFile = $targetDirectory . $photo;
        //only allow image files
        $imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $error = true;
        }
        //check the file size php.ini has an upload_max_filesize, default set to 2M
        //if the file size exceeds the limit the error code is 1
        if ($_FILES["photo"]["error"] == 1) {
            $message = "Sorry, your file is too large. Max of 2M is allowed.";
            $error = true;
        }
        if($error == false) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                //delete old photo if there was one
                if(!empty($_POST["originalPhoto"])) {
                    $file = basename(realpath("../images/products/" . $_POST["originalPhoto"]));
                    //delete the file using unlink
                    unlink($file);
                }
                //set up query to execute
                $sql = "UPDATE item 
                        SET 
                            itemName=:itemName, 
                            photo=:photo,
                            price=:price,
                            salePrice=:salePrice,
                            description=:description, 
                            featured=:featured,
                            categoryId=:categoryId
                        WHERE itemId = :itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":itemName" , $_POST["itemName"], PDO::PARAM_STR);
                $stmt->bindValue(":photo", $photo, PDO::PARAM_STR);
                $stmt->bindValue(":price", $_POST["price"], PDO::PARAM_INT);
                $stmt->bindValue(":salePrice", $_POST["salePrice"], PDO::PARAM_INT);
                $stmt->bindValue(":description", $_POST["description"], PDO::PARAM_STR);
                $stmt->bindValue(":featured", $_POST["featured"], PDO::PARAM_STR);
                $stmt->bindValue(":categoryId", $_POST["categoryId"], PDO::PARAM_STR);
                $stmt->bindValue(":itemId" , $_POST["itemId"], PDO::PARAM_INT);
                //execute SQL query
                $id = $db->executeReadWrite($stmt, false);
                $message = "The item was updated";
            }
            else {
                $message = "Sorry, there was an error uploading your file. Error Code:" . $_FILES["photo"]["error"];
                $photo = "";
            }
        }
    }
    //display the item to be updated
    //get the item id from the query string or from the posted data if the submit button was pressed
    if(isset($_GET["id"])) {
        $catId = $_GET["id"];
    }
    elseif (isset($_POST["itemId"])) {
        $catId = $_POST["itemId"];
    }
    else {
        $catId = 0;
    }

    $sql = "SELECT 
                itemId, 
                itemName,
                photo, 
                price, 
                salePrice,
                description, 
                featured, 
                categoryId
            FROM item 
            WHERE itemId = :itemId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":itemId" , $catId, PDO::PARAM_INT);
    $rows = $db->executeSQL($stmt);




    // Select all items to display in a table.
    $sql = "SELECT 
                itemId, 
                itemName,
                photo, 
                price, 
                salePrice,
                description, 
                featured, 
                categoryId
            FROM item";
    $stmt = $pdo->prepare($sql);
    $itemRows = $db->executeSQL($stmt);
    //start buffer
    ob_start();
    
    //display form
    include "./templates/item-edit-form.html.php";
    // Display items.
    include "./templates/display-items.html.php";
    $output = ob_get_clean();
    include "./templates/layout.html.php";
?>