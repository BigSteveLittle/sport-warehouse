<?php
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

    $title = "Theme";
    $pageHeading = "Frame Colour";
    $message = "";

    if(isset($_POST["submit"])) {
        // Get the selected colour theme. 
        $_SESSION["theme"] = $_POST["theme"];
        $theme = $_SESSION["theme"] . ".css";
    }

    //start buffer
    ob_start();

    //display page content
    include "templates/theme-form.html.php";

    $output = ob_get_clean();
    
    include "templates/layout.html.php";
?>