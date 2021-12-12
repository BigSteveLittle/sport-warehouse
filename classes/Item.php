<?php
// Item is a class that will handle all processes in displaying Sports Warehouse product Items. 

    // Class Map.

    // PROPERTIES
    // - _itemId.
    // - _itemName.
    // - _photo.
    // - _price.
    // - _salePrice.
    // - _description.
    // - _featured.
    // - _itemCategoryName.
    // _db.

    // METHODS
    // 1. -- construct (access the db settings and create a new DBAccess object).
    // 2. + getItem() (get and return values for a single item using the itemId i.e. the primary key).
    // 3. + getItems() (get and return values for all items using the itemId i.e. the primary key).
    // 4. + getItemCount() (obtain a count of all rows).
    // 5. + displayItemCategory() (display the categoryName for a single item).
    // 6. + getItemsSort() (get and return values for all items as a sortable table).
    // 7. + getItemsByCategoryId() (get and return values for all items of a particular categoryId).
    // 8. + getFeaturedItems() (get and return values for all featured items).
    // 9. + searchItems() (allow a user to submit a search query and return any results).

// Call the 'DBAccess' class.
require_once("DBAccess.php");

// Create the class 'Item'. 
class Item {
    // Set up properties.
    private $_itemId;
    private $_itemName;
    private $_photo;
    private $_price;
    private $_salePrice;
    private $_description;
    private $_featured;
    private $_itemCategoryName;
    private $_db;

    // 1. A constructor method to access the db settings and create a new DBAccess object. 
    public function __construct() {
        // Call the database settings.
        include "settings/db-sportswh.php";
        // Start try/catch. 
        try {
            // Create a new DBAccess object. 
            $this->_db = new DBAccess($dsn, $username, $password);
        }
        catch(PDOException $e) {
            die("Owch! Bro, unable to connect to the database. " . $e->getMessage());
        }
    }
    // 2. A method to get item the ID. 
    public function getItemId() {
        return $this->_itemId;
    }

    // 3. A method to get the product name.
    public function getItemName() {
        return $this->_itemName;
    }
    
    // 4. A method to get the product price wether 'price' or 'sale'.
   public function getCartPrice($itemId) {
    // Begin try/catch. 
    try {
        // Assign a value to $cartPrice.
        // $cartPrice = "";
        // Connect to the database.
        $pdo = $this->_db->connect();
        // Assign an SQL statement calling for the categoryName for a single item to variable $sql. Use a placeholder for itemCategoryId.
        $sql = "SELECT price, salePrice 
                FROM item
                WHERE itemId = :itemId";
        // Prepare the statement. 
        $stmt = $pdo->prepare($sql);
        // Bind the placeholder to the value. 
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
        // Execute the SQL statement and assign to $rows. 
        $rows = $this->_db->executeSQL($stmt);
        // Get the row (there will only be one row).
        $row = $rows[0];
        // Assign the values to the properties.
        $this->_price = $row["price"];
        $this->_salePrice = $row["salePrice"];
        if(empty($row["salePrice"]) || $row["salePrice"] === 0) {
            $cartPrice = $row["price"];
        }
        else {
            $cartPrice = $row["salePrice"];
        }
        return $cartPrice;
    }
    catch(PDOException $e) {
        throw $e;
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
    // 4. A method to obtain a count of all rows.
    public function getItemCount() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for a count of rows from the item table to variable $sql.
            $sql = "SELECT COUNT(*) 
                    FROM item";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql); 
            // Execute the SQL statement and assign to $rows. 
            $value = $this->_db->executeSQLSingleValue($stmt);
            // Return count to $value.
            return $value; 
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 5. A method to display the categoryName for a single item.
    public function displayItemCategory($itemCategoryId) {
        // Begin try/catch. 
        try {
            // Connect to the database.
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for the categoryName for a single item to variable $sql. Use a placeholder for itemCategoryId.
            $sql = "SELECT DISTINCT c.categoryName 
                    FROM category AS c 
                        INNER JOIN item AS i 
                            WHERE item.categoryId = :itemCategoryId";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholder to the value. 
            $stmt->bindValue(':itemCategoryId', $itemCategoryId, PDO::PARAM_INT);
            // Execute the SQL statement and assign to $rows. 
            $rows = $this->_db->executeSQL($stmt);
            // Get the row (there will only be one row).
            $row = $rows[0];
            // Assign the values to the properties.
            $this->_itemCategoryName = $row["categoryName"];
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 6. A method to get and return values for all items using the itemId i.e. the primary key.
    public function getItemsSort() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Check if the sort heading is pressed by the user. 
            if(isset($_GET["sort"])) {
                // Define an array to store columns for the ORDER BY statement.
                $orderByFields = ["itemName", "price", "salePrice", "categoryName"];
                // Assign the GET method to a variable.
                $sort = $_GET["sort"];
                // Check if $sort is in the $orderByFields array.
                if(in_array($sort, $orderByFields)) {
                    // Assign the query statement to $sql. 
                    $sql = "SELECT 
                                item.itemId, 
                                item.itemName, 
                                item.price, 
                                item.salePrice,
                                item.description, 
                                -- item.categoryId, 
                                category.categoryName,
                                item.photo
                            FROM item 
                                INNER JOIN category 
                                    WHERE item.categoryId = category.categoryId
                            ORDER BY $sort";
                    // Prepare the statement.
                    $stmt = $pdo->prepare($sql); 
                }
                else {
                    // Query statement if $sort is not contained in $orderByFields. 
                    $sql = "SELECT 
                                item.itemId, 
                                item.itemName, 
                                item.price, 
                                item.salePrice,
                                item.description, 
                                -- item.categoryId, 
                                category.categoryName,
                                item.photo
                                FROM item 
                                INNER JOIN category 
                                    WHERE item.categoryId = category.categoryId";
                    // Prepare the statement.
                    $stmt = $pdo->prepare($sql);
                }
            }
            else {
                // Set up the SQL statement. 
                $sql = "SELECT 
                                item.itemId, 
                                item.itemName, 
                                item.price, 
                                item.salePrice,
                                item.description, 
                                -- item.categoryId, 
                                category.categoryName,
                                item.photo
                                FROM item 
                                INNER JOIN category 
                                    WHERE item.categoryId = category.categoryId";
                // Prepare the statement.
                $stmt = $pdo->prepare($sql);
            }
            // Execute the SQL statement and assign to $rows. 
            $rows = $this->_db->executeSQL($stmt);
            // Return all table rows.
            return $rows;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    /**
     * 7. A method to get and return values for all items of a particular categoryId.
     *
     * @param string $itemCategoryId The categoryId of an item from the 'item' table of the database. 
     * @return string $rows The 'item' table attributes of the items that have a categoryId of $itemCategoryId. 
     */
    public function getItemsByCategoryId($itemCategoryId) {
        // Begin try/catch. 
        try {
            
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information from the item table to variable $sql.
            $sql = "SELECT * 
                    FROM item
                    WHERE categoryId = :categoryId";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql); 
            
            // Bind the placeholder to the value. 
            $stmt->bindValue(':categoryId', $itemCategoryId, PDO::PARAM_INT);
            // Execute the SQL statement and assign to $rows. 
            $rows = $this->_db->executeSQL($stmt);
            // Return all table rows.
            return $rows;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 8. A method to get and return values for all featured items.
    public function getFeaturedItems() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information from the item table to variable $sql.
            $sql = "SELECT * 
                    FROM item
                    WHERE featured = 1";
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
    // 9. A method to allow a user to submit a search query and return any results.
    public function searchItems() {
        // Begin try/catch. 
        try {
            
            // Assign the search query to a variable.
            $search = $_GET["search"];
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information from the item table to variable $sql.
                    $sql = "SELECT 
                                itemId,
                                itemName, 
                                price,
                                salePrice,
                                description, 
                                photo 
                            FROM item
                            WHERE itemName 
                            LIKE :itemName
                            OR description 
                            LIKE :description";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql); 
            // Bind the placeholder to the value. 
            $stmt->bindValue(":itemName", "%$search%");
            $stmt->bindValue(":description", "%$search%");
            // Execute the SQL statement and assign to $rows. 
            $itemRows = $this->_db->executeSQL($stmt);

            return $itemRows;
                
        }
        catch(PDOException $e) {
            throw $e;
        }  
    }
}
?>
