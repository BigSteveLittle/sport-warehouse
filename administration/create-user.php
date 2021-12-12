<?php
    // Call the Authentication class. 
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

    // Page title and heading.
    $title = "Create user";
    $pageHeading = "Create new user";

    // Call the protect method.
    AdminAuthentication::protect();

    //NOTE: no need to create an instance of the class

    // Assign
    $message = "";
    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        //add user
        $message = AdminAuthentication::createUser($_POST["username"], $_POST["password"]) . " ID was created successfully.";
    
    }
    //start buffer
    ob_start();

    //display create user form
    include "./templates/create-user-form.html.php";
    $output = ob_get_clean();
    include "./templates/layout.html.php";
?>