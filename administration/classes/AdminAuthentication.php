<?php
// Authentication is a class that will handle all transactions to do with user access. 

    // Class Map.

    // PROPERTIES
    // c LoginPageURL.
    // c SuccessPageURL.
    // -s _db.

    // METHODS
    // 1. +s createUser($uname, $pword) (create a new user).
    // 2. +s login($uname, $pword) (the logging in process).
    // 3. +s logout() (log the user out).
    // 4. +s protect() (check if a user is logged in and redirect to login if not).

// Call the 'DBAccess' class.
require_once("../classes/DBAccess.php");

// Create the class 'Category'. 
class AdminAuthentication {
    // Properties.
    const LoginPageURL = "login.php";
    const SuccessPageURL = "success.php";
    private static $_db;

    // 1. Method to create a new user.
    public static function createUser($uname, $pword) {
        // Hash the password.
        $hash = password_hash($pword, PASSWORD_DEFAULT);
        // Get the database settings.
        include "../settings/db-sportswh.php";
        // Begin try/catch. 
        try {
            // Create a database object (as class is 'static' 'self::' is used instead of '$this->'). 
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch(PDOException $e) {
            die("Man can't connect to that little database, Oh what to do? " . $e->getMessage());
        }
        // Add the user.
        // Begin try/catch. 
        try {
            // Connect to the database (as class is 'static' 'self::' is used instead of '$this->'). 
            $pdo = self::$_db->connect();
            // Set up the SQL. 
            $sql = "INSERT INTO 
                        user(
                            userName, 
                            password)
                        VALUES(
                            :userName, 
                            :password)";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the values to the placeholders. 
            $stmt->bindParam(":userName", $uname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
            // Execute the SQL statement (as class is 'static' 'self::' is used instead of '$this->'). 
            $id = self::$_db->executeReadWrite($stmt); 

            return $id;
        }
        catch(PDOException $e) {
            throw $e;
        }
        return "New user added. Well done my Dude";
    }

    // 2. A method for the logging in process. 
    public static function login($uname, $pword) {
        // Assign the variable $hash. 
        $hash = "";
        // Get the database settings. 
        include "../settings/db-sportswh.php";
        // Begin try/catch. 
        try {
            // Create database object (as class is 'static' 'self::' is used instead of '$this->'). 
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch(PDOException $e) {
            die("Sorry mate. Unable to connect through the DBAccess class " . $e->getMessage());
        }
        // Check if the user exists.
        // Begin try/catch. 
        try {
            // Create the database object (as class is 'static' 'self::' is used instead of '$this->'). 
            $pdo = self::$_db ->connect();
            // Set up the SQL statement. 
            $sql = "SELECT password 
                    FROM user
                    WHERE userName = :userName";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the value to the holder.
            $stmt->bindParam(":userName", $uname, PDO::PARAM_STR);
            // Execute the SQL statement. 
            $hash = self::$_db->executeSQLSingleValue($stmt);
        }
        catch(PDOException $e) {
            throw $e;
        }
        // Match the password with the $hash. 
        if(password_verify($pword, $hash)) {
            // Successful match. 
            $_SESSION["userName"] = $uname;
            // Redirect the user to success page.
            header("Location: " . self::SuccessPageURL);
            exit;
        }
        else {
            return false;
        }
    }
    // 3. A method to log the user out. 
    public static function logout() {
        // Remove the suer from the SESSION.
        unset($_SESSION["userName"]);
        // Redirect the user back to the login page.
        header("Location: " . self::LoginPageURL);
        exit;
    }

    // 4. A method to check if a user is logged in and redirect to login if not.
    public static function protect() {
        // If user is not logged in. 
        if(!isset($_SESSION["userName"])) {
            // Send the user to the login page.
            header("Location: " . self::LoginPageURL);
            exit;
        }
    }
    // 1. Method to create a new user.
    public static function changePassword($pword, $uname) {
        // Hash the password.
        $hash = password_hash($pword, PASSWORD_DEFAULT);
        // Get the database settings.
        include "../settings/db-sportswh.php";
        // Begin try/catch. 
        try {
            // Create a database object (as class is 'static' 'self::' is used instead of '$this->'). 
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch(PDOException $e) {
            die("Man can't connect to that little database, Oh what to do? " . $e->getMessage());
        }
        // Add the user.
        // Begin try/catch. 
        try {
            // Connect to the database (as class is 'static' 'self::' is used instead of '$this->'). 
            $pdo = self::$_db->connect();
            // Set up the SQL. 
            $sql = "UPDATE 
                        user 
                            SET password = :password
                        WHERE userName = :userName";
            // Prepare the statement. 
            $stmt = $pdo->prepare($sql);
            // Bind the values to the placeholders. 
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
            $stmt->bindParam(":userName", $uname, PDO::PARAM_STR);
            // Execute the SQL statement (as class is 'static' 'self::' is used instead of '$this->'). 
            $id = self::$_db->executeReadWrite($stmt);

            return "password change for userId: " . $id . " was successful, just quietly.";
        }
        catch(PDOException $e) {
            throw $e;
        }
        return "New password added. Well done Bro";
    }

}