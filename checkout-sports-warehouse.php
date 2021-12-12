<?php
    // Call the ShoppingCart class.
    require_once "classes/ShoppingCart.php";

    // Check if a session has already started. If not start one.
    if(!isset($_SESSION)) {
        session_start();
    }

    // Page identifier.
    $title = "Checkout - Sports Warehouse";

    // Start the buffer.
    ob_start();

    $orderId = 0;

    // Check if pay button was pressed and cart is in the session.
    if(isset($_POST["ch-pay"]) && isset($_SESSION["cart"])) {
        // Get all the posted data.
        $address = $_POST["ch-address"];
        $phone = $_POST["ch-phone"];
        $creditcard = $_POST["ch-creditcard"];
        $csv = $_POST["ch-csv"];
        $email = $_POST["ch-email"];
        $expiry = $_POST["ch-expiry"];
        $firstName = $_POST["ch-firstName"];
        $lastName = $_POST["ch-lastName"];
        $nameOnCard = $_POST["ch-card-name"];
        // Retrieve the shopping cart from session. 
        $cart = $_SESSION["cart"];
        // Save the checkout details to 'shoppingorder'. 
        $orderId = $cart->saveCart($address, $phone, $creditcard, $csv, $email, $expiry, $firstName, $lastName, $nameOnCard);
        // Validate the checkout form input.
        $checkedOut = processCheckout();
        }
    else {
        // Display the checkout form again if there are missing fields.
        $checkedOut = false;
        $missingFields = [];
        include "templates/checkout-form.html.php";
    }
    // A function to check the form for missing fields an invalid email.
    function processCheckout() {
        // Set up an array of all mandatory fields.
        $requiredFields = ["ch-address","ch-creditcard", "ch-csv", "ch-email", "ch-expiry", "ch-firstName", "ch-lastName", "ch-card-name"];
        // Assign an array to capture the missing fields and invalid email.
        $missingFields = [];
        // Check each required field has a value. 
        foreach($requiredFields as $requiredField) {
            if(!isset($_POST[$requiredField]) || !$_POST[$requiredField]) {
                // If a field is missing add it to the '$missingFields' array.
                $missingFields[] = $requiredField;
            }
        }
        // Check if the email input is a valid email address. 
        $validEmail = "ch-email";
        if(!filter_var($_POST[$validEmail], FILTER_VALIDATE_EMAIL)) {
            $missingFields[] = $validEmail;
        }
        // Display all missing and invalid fields. 
        if($missingFields) {
            include "templates/checkout-form.html.php";
            $checkedOut = false;
        }
        else {
            // If all fields are complete and valid display the conformation.
            $checkedOut = true;
        }
        return $checkedOut;
    }

    // A function to attach the '.error' class to the missing fields.
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

    // Output the contents of the buffer.
    $output = ob_get_clean();

    // Add the HTML layout. 
    include "expanded-header-footer.php";
?>