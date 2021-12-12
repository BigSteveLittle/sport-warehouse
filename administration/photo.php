<?php
    require_once "classes/DBAccess.php";
    $title = "Update";
    $pageHeading = "Employees";
    //get database settings
    include "settings/db.php";
    //create database object
    $db = new DBAccess($dsn, $username, $password);
    //connect to database
    $pdo = $db->connect();
    $message = "";
    $error = false;
    //update employee when the button is clicked
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
                    $file = "../images/products/" . $_POST["originalPhoto"];
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