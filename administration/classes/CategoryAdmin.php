<?php
// CATEGORY ADMIN is a class that will handle all admin staff processes including: adding, updating and deleting. 

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
    // 5. + insertNewCategory() (add a new category via a form).

// Call the 'DBAccess' class.
require_once("../classes/DBAccess.php");

// Create the class 'Category'. 
class CategoryAdmin {
    // Set up properties.
    private $_categoryName;
    private $_categoryId;
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
            die("Mannnnn, we failed to connect to for the CategoryAdmin class. " . $e->getMessage());
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
    // 2. A method to allow the insertion (adding) of a new Category.
    public function insertNewCategory() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign the query statement to $sql. 
            $sql = "INSERT INTO
                            category(
                                categoryName
                            )
                            values(
                                :categoryName
                            )";
            // Prepare the SQL statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholders with values.
            $stmt->bindValue(":categoryName", $_POST["categoryName"], PDO::PARAM_STR);
            // Execute SQL query using the executeSQL method. 
            $id = $this->_db->executeReadWrite($stmt, true);
            
            return $id;
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to allow the deletion of a Category.
    public function deleteCategory() {
        // Begin try/catch. 
        try {
            // Connect to the database. 
            $pdo = $this->_db->connect();
            // Assign the query statement to $sql. 
                    $sql = "DELETE FROM
                                category
                            WHERE 
                                categoryID = :categoryID";
            // Prepare the SQL statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the placeholders with values.
            $stmt->bindValue(":categoryID", $_GET["id"], PDO::PARAM_INT);
            // Execute SQL query using the executeSQL method. 
            $id = $this->_db->executeReadWrite($stmt, true);
            
            return $id;
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
    // 3. A method to allow the deletion of a Category.
    public function updateCategory() {
        // Begin try/catch. 
        try {
            if(!empty($_POST["categoryName"]) && !empty($_POST["categoryId"])) {
                // Connect to the database. 
                $pdo = $this->_db->connect();
                // Assign the query statement to $sql. 
                        $sql = "UPDATE category 
                                SET categoryName=:categoryName 
                                WHERE categoryId = :categoryId";
                // Prepare the SQL statement. 
                $stmt = $pdo->prepare($sql);
                // Bind the placeholders with values.
                $stmt->bindValue(":categoryName", $_POST["categoryName"], PDO::PARAM_STR);
                $stmt->bindValue(":categoryId", $_POST["categoryId"], PDO::PARAM_INT);
                // Execute SQL query using the executeSQL method. 
                $id = $this->_db->executeReadWrite($stmt, true);
                
                return $id;
            }
        } 
        catch(PDOException $e) {
            throw $e;
        }
    }
    // A function to check the form for missing fields an invalid email.
    function processForm() {
        // Set up an array of all mandatory fields.
        $requiredFields = ["cf-firstName", "cf-lastName", "cf-email"];
        // Assign an array to capture the missing fields and invalid email.
        $missingFields = [];
        // Check each required field has a value using 'isset' and check the fields exist. 
        foreach($requiredFields as $requiredField) {
            if(!isset($_POST[$requiredField]) || !$_POST[$requiredField]) {
                // If a field is missing add it to the '$missingFields' array.
                $missingFields[] = $requiredField;
            }
        }
        // Check if the email field is a valid email address. 
        $validEmail = "cf-email";
        if(!filter_var($_POST[$validEmail], FILTER_VALIDATE_EMAIL)) {
            $missingFields[] = $validEmail;
        }
        // Display all missing and invalid fields. 
        if($missingFields) {
            include "templates/contact-form.html.php";
            $redirect = false;
        }
        else {
            // If all fields are complete and valid display the conformation.
            $redirect = true;
        }
        return $redirect;
    }
    
    // A function to attache the '.error' class to a missing field.
    function validateField($fieldName, $missingFields) {
        if(in_array($fieldName, $missingFields)) {
            return ' class="error"';
        }
    }

    // A function to get the field values.
    function setValue($fieldName) {
        if(isset($_POST[$fieldName])) {
            return $_POST[$fieldName];
        }
    }
}
?>