<?php
// Category is a class that will handle all processes in displaying Sports Warehouse Categories. 

    // Class Map.

    // PROPERTIES
    // - _categoryName.
    // - _categoryID.
    // _db.

    // METHODS
    // 1. -- construct (access the db settings and create a new DBAccess object).
    // 2. + getCategoryID() (get the categoryId i.e. the primary key).
    // 3. + getCategories() (Get and return values for all categories using the categoryId i.e. the primary key).
    // 4. + getCategoryCount() (obtain a count of all rows).

// Call the 'DBAccess' class.
require_once("DBAccess.php");

// Create the class 'Category'. 
class Category {
    // Set up properties.
    private $_categoryName;
    private $_categoryId;
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
            die("Clearly my Dude, we were unable to connect to the database. " . $e->getMessage());
        }
    }
    // 2. A method to get and return values for a single category using the categoryId i.e. the primary key.
    public function getCategory($categoryId) {
        // Begin try/catch. 
        try {
            // Connect to the database.
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information about a single category to variable $sql. Use a placeholder for categoryId.
            $sql = "SELECT * 
                    FROM category
                    WHERE categoryId = :categoryId";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholder to the value. 
            $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
            // Execute the SQL statement and assign to $rows. 
            $rows = $this->_db->executeSQL($stmt);
            // Get the row (there will only be one row).
            $row = $rows[0];
            // Assign the values to the properties.
            $this->_categoryId = $row["categoryId"];
            $this->_categoryName = $row["categoryName"];
            return $row;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to get and return values for all categories using the categoryId i.e. the primary key.
    public function getCategories() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for all information from the categories table to variable $sql.
            $sql = "SELECT * 
                    FROM category";
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
    public function getCategoryCount() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign an SQL statement calling for a count of rows from the categories table to variable $sql.
            $sql = "SELECT COUNT(*) 
                    FROM category";
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
}
?>
