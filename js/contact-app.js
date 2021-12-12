// Activate 'strict mode'. 
"use strict";
// Reference the '#contact-form' within the DOM. 
const contactForm = document.getElementById("contact-form");

// Check '#contact-form' exists. 
if(contactForm) {
    // Disable HTML validation if JS is enabled. 
    contactForm.setAttribute("novalidate", "");
    // Apply vanilla JS validation using a 'submit' event listener.  
    contactForm.addEventListener("submit", (event) => {
        // Get references to the form fields. 
        // const name = document.getElementById("cf-name");
        const cfFirstName = contactForm.elements["cf-firstName"];
        const cfLastName = contactForm.elements["cf-lastName"];
        const cfPhone = contactForm.elements["cf-phone"];
        const cfEmail = contactForm.elements["cf-email"];
        const cfQuestion = contactForm.elements["cf-question"];
        // Clear all existing error messages that is reset the form.
        hideAllErrors(contactForm);
        // Regular Expression Patterns.
        const regexCfEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const regexChPhone = /^((000|112|106)|(((\+61 ?\(?0?[- ]?)|(\(?0[- ]?))[23478]\)?([- ]?[0-9]){8})|((13|18)([- ]?[0-9]){4}|(1300|1800|1900)([- ]?[0-9]){6}))$/;
        // Validate cfFirstName i.e. must be at least 2 characters. 
        if(cfFirstName.value.trim().length < 2) {
            showError(cfFirstName, event, "Please provide your full first name.");
        }
        // Validate cfLastName i.e. must be at least 2 characters. 
        if(cfLastName.value.trim().length < 2) {
            showError(cfLastName, event, "Please provide your full last name.");
        }
        // Validate chPhone ie must be in a Australian phone number format.
        if(cfPhone.value !== "" && !regexChPhone.test(cfPhone.value)) {
            showError(cfPhone, event, "Please provide an Australian format phone number.");
        }
        // Validate cfEmail i.e. must be in an email format.
        if(!regexCfEmail.test(cfEmail.value)) {
            showError(cfEmail, event, "Please provide a valid email address.");
        }
        // Validate cfQuestion i.e. must be at least 30 characters. 
        if(cfQuestion.value.trim().length === 0) {
            showError(cfQuestion, event, "Did you forget to include your question?");
        }
        else if (cfQuestion.value.trim().length < 30) {
            showError(cfQuestion, event, "Must be 30+ characters.");
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