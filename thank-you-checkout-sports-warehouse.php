<?php
    // Check if a session has already started. If not start one.
    if(!isset($_SESSION)) {
        session_start();
    }
    // Insert page title and heading. 
    $title = "Thank You - Sports Warehouse";

    // Destroy the session! 
    session_destroy();

    // Start the buffer. 
    ob_start();

    // Invoke confirmation page content. 
    include "./templates/confirmation-checkout.html.php";

    // Output the buffer contents. 
    $output = ob_get_clean();

    // Display HTML content.  
    include "expanded-header-footer.php";
?>