// Auto submit the hidden form when URL changes
function submitHiddenForm() {
    let form = document.getElementById("hidden-form");

    if (form) {
        form.submit();
    }
}

// Check for URL change and submit hidden form if necessary
window.addEventListener("DOMContentLoaded", () => {
    // Check the initial URL on page load
    checkAndSubmitForm();

    // Check for URL changes periodically
    setInterval(checkAndSubmitForm, 1000); // Check every 1 second
});

// Function to check current URL and submit form if needed
function checkAndSubmitForm() {
    let currentUrl = window.location.href;

    // Check if the current URL ends with 'profile.php'
    if (currentUrl.endsWith("/profile.php")) {
        // URL has changed to profile.php, submit the hidden form
        submitHiddenForm();
    }
}
