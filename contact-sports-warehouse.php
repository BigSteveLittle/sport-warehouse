<?php
    // Input page title.
    $title = "Contact Us - Sports Warehouse";

    // Start buffer. 
    ob_start();

    // Check if user has clicked the 'Submit' button. 
    if(isset($_POST["cf-submitButton"])) {
        // Validate the form inputs.
        $redirect = processForm();
    }
    else {
        // Display the form again if there are missing fields.
        $redirect = false;
        $missingFields = [];
        include "templates/contact-form.html.php";
    }

    // A function to check the form for missing fields and an invalid email.
    function processForm() {
        // Set up an array of all mandatory fields.
        $requiredFields = ["cf-firstName", "cf-lastName", "cf-email"];
        // Assign an array to capture the missing fields and invalid email.
        $missingFields = [];
        // Check each required field has a value using 'isset' and check the fields exist. 
        foreach($requiredFields as $requiredField) {
            if(!isset($_POST[$requiredField]) || !$_POST[$requiredField]) {
                // If a field is missing add it to the '$missingFields' array.
                $missingFields[] = $requiredField;
            }
        }
        // Check if the email input is a valid email address. 
        $validEmail = "cf-email";
        if(!filter_var($_POST[$validEmail], FILTER_VALIDATE_EMAIL)) {
            $missingFields[] = $validEmail;
        }
        // Display all missing and invalid fields. 
        if($missingFields) {
            include "templates/contact-form.html.php";
            $redirect = false;
        }
        else {
            // If all fields are complete and valid display the conformation.
            $redirect = true;
        }
        return $redirect;
    }
    
    // A function to attache the '.error' class to the missing fields.
    function validateField($fieldName, $missingFields) {
        if(in_array($fieldName, $missingFields)) {
            return ' class="error"';
        }
    }

    // A function to get the field values.
    function setValue($fieldName) {
        if(isset($_POST[$fieldName])) {
            return $_POST[$fieldName];
        }
    }
    
    // Output the buffer contents. 
    $output = ob_get_clean();

    // Insert HTML layout.
    include "expanded-header-footer.php";
?>