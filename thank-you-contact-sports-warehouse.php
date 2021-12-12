<?php
    $title = "Thank You - Sports Warehouse";

    // Start the buffer. 
    ob_start();

    // Invoke confirmation page content. 
    include "./templates/confirmation-contact.html.php";

    // Output the buffer contents. 
    $output = ob_get_clean();

    // Display HTML content.
    include "expanded-header-footer.php";
?>