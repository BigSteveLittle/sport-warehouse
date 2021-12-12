// Activate 'strict mode'. 
"use strict";
// Reference the '#checkout-form' within the DOM. 
const checkoutForm = document.getElementById("checkout");

// Check '#checkout-form' exists. 
if(checkoutForm) {
    // Disable HTML validation if JS is enabled. 
    checkoutForm.setAttribute("novalidate", "");
    // Apply vanilla JS validation using a 'submit' event listener.  
    checkoutForm.addEventListener("submit", (event) => {
        // Get references to the form fields. 
        // const name = document.getElementById("ch-name");
        const chFirstName = checkoutForm.elements["ch-firstName"];
        const chLastName = checkoutForm.elements["ch-lastName"];
        const chAddress = checkoutForm.elements["ch-address"];
        const chPhone = checkoutForm.elements["ch-phone"];
        const chEmail = checkoutForm.elements["ch-email"];
        const chCreditcard = checkoutForm.elements["ch-creditcard"];
        const chCardName = checkoutForm.elements["ch-card-name"];
        const chExpiry = checkoutForm.elements["ch-expiry"];
        const chCsv = checkoutForm.elements["ch-csv"];
        // Clear all existing error messages that is reset the form.
        hideAllErrors(checkoutForm);
        // Regular Expression Patterns.
        const regexchEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const regexChPhone = /^((000|112|106)|(((\+61 ?\(?0?[- ]?)|(\(?0[- ]?))[23478]\)?([- ]?[0-9]){8})|((13|18)([- ]?[0-9]){4}|(1300|1800|1900)([- ]?[0-9]){6}))$/;
        // Validate chFirstName i.e. must be at least 2 characters. 
        if(chFirstName.value.trim().length < 2) {
            showError(chFirstName, event, "Please provide your full first name.");
        }
        // Validate chLastName i.e. must be at least 2 characters. 
        if(chLastName.value.trim().length < 2) {
            showError(chLastName, event, "Please provide your full last name.");
        }
        // Validate chLastName i.e. must be at least 2 characters. 
        if(chAddress.value.trim().length < 2) {
            showError(chAddress, event, "Please provide your full address.");
        }
        // Validate chPhone ie must be in a Australian phone number format.
        if(chPhone.value !== "" && !regexChPhone.test(chPhone.value)) {
            showError(chPhone, event, "Please provide an Australian format phone number.");
        }
        // Validate chEmail i.e. must be in an email format.
        if(!regexchEmail.test(chEmail.value)) {
            showError(chEmail, event, "Please provide a valid email address.");
        }
        // Validate chCreditcard i.e. must be exactly 16 characters. 
        if(/\D/.test(chCreditcard.value)) {
            showError(chCreditcard, event, "Must only be digits (0-9)");
        }
        else if(chCreditcard.value.trim().length !== 16) {
            showError(chCreditcard, event, "Must be 16 digits only.");
        }
        // Validate chCardName i.e. must be at least 4 characters. 
        if(chCardName.value.trim().length < 4) {
            showError(chCardName, event, "Please provide your full name.");
        }
        // Validate chExpiry date ie must be between 4 and 7 characters.
        if(chExpiry.value.trim().length < 4 || chExpiry.value.trim().length > 7) {
            showError(chExpiry, event, "Please provide your expiry date.");
        }
        // Validate chCsv i.e. must be 3 digits. 
        if(/\D/.test(chCsv.value)) {
            showError(chCsv, event, "Must only be digits (0-9)");
        }
        else if(chCsv.value.trim().length !== 3) {
            showError(chCsv, event, "Can only be 3 digits long.");
        }
    });
}
/**
 * Show an error message for an invalid entry in a field.
 * @param {object} field The form field that is invalid.
 * @param {object} event The event object of the form that is submitted.
 * @param {string} errorMessage The custom error message to show.
 */
// FUNCTIONS.
// A function to add the class '.error-row' if a field is not valid.
function showError(field, event, errorMessage = null) {
    // Cancel the event i.e. stop the form from submitting. 
    event.preventDefault();
    // display error message via '.error-row'. 
    field.parentElement.classList.add("error-row");
    // Check if a custom error message is provided. If not, use the existing span already in the DOM (if it exists).
    if(errorMessage) {
        // Find the '.error-message' span in the DOM.
        let errorSpan = field.parentElement.querySelector(".error-message");
        // Check if the error span does NOT exist (incase we need to create a new one).
        if(!errorSpan) {
            // Create a span, add class and add it to the DOM.
            errorSpan = document.createElement("span");
            errorSpan.classList.add("error-message");
            field.parentElement.appendChild(errorSpan);
        }
        // Update the error message.
        errorSpan.innerText = errorMessage;
    }
}
/**
 * Hide all error messages within the form.
 * @param {object} form The form within all errors need to be hidden.
 */
function hideAllErrors(form) {
    // Find all elements with the 'error-row' class within the the form.
    const errorRows = form.querySelectorAll(".error-row");
    // Loop through each element and remove the 'error-row' class from the form.
    for(const errorRow of errorRows) {
        errorRow.classList.remove("error-row");
    }
}