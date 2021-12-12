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
    $title = "Change Password";
    $pageHeading = "Change Password";

    // Assign
    // $uName = $_SESSION["userName"];
    $message = "";
    if(!empty($_POST["password1"]) && !empty($_POST["password2"]) && ($_POST["password1"] === $_POST["password2"])) {
    //add a new password
    $message = AdminAuthentication::changePassword($_POST["password1"], $_SESSION["userName"]);
    }
    //start buffer
    ob_start();
    //display create user form
    include "./templates/change-password-form.html.php";
    $output = ob_get_clean();
    include "./templates/layout.html.php";
?>