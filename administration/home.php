<?php
    require_once "./classes/AdminAuthentication.php";

    session_start();

    // Read stylesheet theme from session. 
    if(isset($_SESSION["theme"])) {
        $theme = $_SESSION["theme"] . ".css";
    }
    else {
        $theme = "styles.css";
    }

    // Begin a SESSION.
    if(!isset($_SESSION)) {
        session_start();
    }

    $title = "Administration Home - Sports Warehouse";
    $pageHeading = "Administration Home - Sports Warehouse";

    // Call the protect method.
    AdminAuthentication::protect();

    // Start the buffer. 
    ob_start();

    // Invoke confirmation page content. 
    include "./templates/admin-home-links.html.php";

    // Display HTML content. 
    $output = ob_get_clean();

    // Invoke HTML layout. 
    include "./templates/layout.html.php";
?>