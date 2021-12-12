<?php
// ITEM ADMIN is a class that will handle all admin staff processes including: adding, updating and deleting. 

    // Class Map.

    // PROPERTIES
    // - _itemName.
    // - _itemID.
    // _db.

    // METHODS
    // 1. -- construct (access the db settings and create a new DBAccess object).
    // 2. + getItemID() (get the itemId i.e. the primary key).
    // 3. + getItems() (Get and return values for all items using the itemId i.e. the primary key).
    // 4. + getItemCount() (obtain a count of all rows).
    // 5. + insertNewItem() (add a new item via a form).

// Call the 'DBAccess' class.
require_once("../classes/DBAccess.php");

// Create the class 'item'. 
class ItemAdmin {
    // Set up properties.
    private $_itemName;
    private $_itemId;
    private $_db;

    // 1. A constructor method to access the db settings and create a new DBAccess object. 
    public function __construct() {
        // Call the database settings.
        include "../settings/db-sportswh.php";
        // Start try/catch. 
        try {
            // Create a new DBAccess object. 
            $this->_db = new DBAccess($dsn, $username, $password);
        }
        catch(PDOException $e) {
            die("Mannnnn, we failed to connect to for the itemAdmin class. " . $e->getMessage());
        }
    }
    // 2. A method to get and return values for a single item using the itemId i.e. the primary key.
    public function getItem($itemId) {
        // Begin try/catch. 
        try {
            // Connect to the database.
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information about a single item to variable $sql. Use a placeholder for itemId.
            $sql = "SELECT * 
                    FROM item
                    WHERE itemId = :itemId";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholder to the value. 
            $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
            // Execute the SQL statement and assign to $rows. 
            $itemRows = $this->_db->executeSQL($stmt);
            // Get the row (there will only be one row).
            $itemRow = $itemRows[0];
            // Assign the values to the properties.
            $this->_itemId = $itemRow["itemId"];
            $this->_itemName = $itemRow["itemName"];
            $this->_price = $itemRow["price"];
            $this->_salePrice = $itemRow["salePrice"];
            $this->_description = $itemRow["description"];
            $this->_featured = $itemRow["featured"];
            $this->_categoryId = $itemRow["categoryId"];
            $this->_photo = $itemRow["photo"];

            return $itemRow;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to get and return values for all items using the itemId i.e. the primary key.
    public function getItems() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information from the item table to variable $sql.
            $sql = "SELECT * 
                    FROM item";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql); 
            // Execute the SQL statement and assign to $rows. 
            $rows = $this->_db->executeSQL($stmt);
            // Return all table rows.
            return $rows;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 2. A method to allow the insertion (adding) of a new item.
    public function insertNewItem() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            $message = "";
            $error = false;
            //save the file
            //specify directory where image will be saved
            $targetDirectory = "../images/products/";
            //get the filename
            $photo = basename($_FILES["photo"]["name"]);
            //set the entire path
            $targetFile = $targetDirectory . $photo;
            // echo $targetFile;
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
                $message = "The file $photo has been uploaded.";
                }
                else {
                    $message = "Sorry, there was an error uploading your file. Error Code:" . $_FILES["photo"]["error"];
                    $photo = "";
                }
            }
            else {
                $photo = "sportsPlaceholder.png";
            }
            // Assign the query statement to $sql. 
            $sql = "INSERT INTO
                            item(
                                itemName,
                                photo, 
                                price, 
                                salePrice,
                                description, 
                                featured, 
                                categoryId
                            )
                            values(
                                :itemName,
                                :photo, 
                                :price, 
                                :salePrice,
                                :description, 
                                :featured, 
                                :categoryId
                            )";
            // Prepare the SQL statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholders with values.
            $stmt->bindValue(":itemName", $_POST["itemName"], PDO::PARAM_STR);
            $stmt->bindValue(":photo", $photo, PDO::PARAM_STR);
            $stmt->bindValue(":price", $_POST["price"], PDO::PARAM_STR);
            $stmt->bindValue(":salePrice", $_POST["salePrice"], PDO::PARAM_STR);
            $stmt->bindValue(":description", $_POST["description"], PDO::PARAM_STR);
            $stmt->bindValue(":featured", $_POST["featured"], PDO::PARAM_INT);
            $stmt->bindValue(":categoryId", $_POST["categoryId"], PDO::PARAM_INT);
            // Execute SQL query using the executeReadWrite method. 
            $id = $this->_db->executeReadWrite($stmt, true);
            
            return $id;
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to allow the deletion of a item.
    public function deleteItem() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign the query statement to $sql. 
                    $sql = "DELETE FROM
                                item
                            WHERE 
                                itemId = :itemId";
            // Prepare the SQL statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholders with values.
            $stmt->bindValue(":itemId", $_GET["id"], PDO::PARAM_INT);
            // Execute SQL query using the executeSQL method. 
            $id = $this->_db->executeReadWrite($stmt, true);
            
            return $id;
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to allow the deletion of a item.
    public function updateItem() {
        // Begin try/catch. 
        try {
                // Connect to the database. 
                $pdo = $this->_db->connect();
                $message = "";
                $error = false;
                //check if the image file exists
                if(!empty($_POST["photo"])) {
                
                //save the file
                //specify directory where image will be saved
                $targetDirectory = "../images/products/";
                //get the filename
                $photo = basename($_FILES["photo"]["name"]);
                //set the entire path
                $targetFile = $targetDirectory . $photo;
                // echo $targetFile;
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
                            $message = "The file $photo has been uploaded.";
                        }
                    }
                    else {
                        $message = "Sorry, there was an error uploading your file. Error Code:" . $_FILES["photo"]["error"];
                        $photo = "";
                    }
                }
                else {
                    $photo = "sportsPlaceholder.png";
                }
            }
            else {
                $photo = $_POST["originalPhoto"];
            }
                // Assign the query statement to $sql. 
                $sql = "UPDATE item 
                SET 
                    itemName='df', 
                    photo='df',
                    price=1,
                    salePrice=1,
                    description='df', 
                    featured=1,
                    categoryId=1
                WHERE itemId = 1";
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
                // Prepare the SQL statement. 
                $stmt = $pdo->prepare($sql);
                // Bind the placeholders with values.
                $stmt->bindValue(":itemName", $_POST["itemName"], PDO::PARAM_STR);
                $stmt->bindValue(":photo", $photo, PDO::PARAM_STR);
                $stmt->bindValue(":price", $_POST["price"], PDO::PARAM_STR);
                $stmt->bindValue(":salePrice", $_POST["salePrice"], PDO::PARAM_STR);
                $stmt->bindValue(":description", $_POST["description"], PDO::PARAM_STR);
                $stmt->bindValue(":featured", $_POST["featured"], PDO::PARAM_INT);
                $stmt->bindValue(":categoryId", $_POST["categoryId"], PDO::PARAM_INT);
                $stmt->bindValue(":itemId", $_POST["itemId"], PDO::PARAM_INT);
                // Execute SQL query using the executeSQL method. 
                $id = $this->_db->executeReadWrite($stmt, false);
                
                return $id;
            
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
}
?>