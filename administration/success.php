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

    // Insert title and headings.
    $title = "Success";
    $pageHeading = "Login Successful";

    // Add username to the SESSION.
    $loginName = $_SESSION["userName"];

    // Start buffer
    ob_start();

    // Display success form
    include "./templates/success.html.php";

    // Output the buffer.
    $output = ob_get_clean();

    // Insert HTML header and footer. 
    include "./templates/layout.html.php";
?>