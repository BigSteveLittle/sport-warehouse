<?php
    // Call the Item class.
    require_once "classes/Item.php";

    // Insert page title and heading. 
    $title = "About - Sports Warehouse";

    // Start the buffer. 
    ob_start();

    // Insert the About Page content.
    include "templates/about-sw.html.php";

    // Empty the buffer the $output variable. 
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>