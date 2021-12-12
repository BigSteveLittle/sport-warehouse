<?php

    // Insert page title. 
    $title = "Home - Sports Warehouse";

    // Start the buffer. 
    ob_start();

    // Insert slideshow for desktop.
    include "templates/slideshow-home-page.html.php";

    // Empty the buffer of the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
    
?>