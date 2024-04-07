function editProfile() {
    var button = document.getElementById("editButton");
    var currentEmailElement = document.getElementById("currentEmail");
    var emailInput = document.getElementById("emailInput");

    // if the current text is Edit, turns into Save
    if (button.innerText === "Edit") {
        button.innerText = "Save";

        currentEmailElement.style.display = "none";
        emailInput.style.display = "inline";
    }
    // Save button is clicked, auto submit form then turns into Edit text
    else {
        // Submit the form
        document.getElementById("editForm").submit();
        button.innerText = "Edit";

        currentEmailElement.style.display = "inline";
        emailInput.style.display = "none";
    }
}

function changePasswordAutoSubmission() {
    document.getElementById("changePasswordForm").submit();
}
