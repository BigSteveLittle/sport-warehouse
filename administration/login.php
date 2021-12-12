<?php
    // Call the Auth class.
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

    // Add title and page headings.
    $title = "Login";
    $pageHeading = "Login";

    // NOTE: no need to create an instance of the class

    // Assign the $message variable.
    $message = "";

    // check in the login has been instigated.
    if(isset($_POST["loginSubmit"])) {
        if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        //authenticate user
        $loginSuccess = AdminAuthentication::login($_POST["username"], $_POST["password"]);
        // there is an error.
            if(!$loginSuccess) {
                $message = "Hey Sis, your username or password are incorrect";
                $error = true;
            }
        }
    }
    // Start buffer
    ob_start();

    // Display create user form
    include "./templates/login-form.html.php";

    // Output the buffer.
    $output = ob_get_clean();

    // Include the HTML header footer. 
    include "./templates/login-logout-layout.html.php";
?>