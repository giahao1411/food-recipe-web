function editProfile() {
    var button = document.getElementById("editButton");
    var currentUsernameElement = document.getElementById("currentUsername");
    var currentEmailElement = document.getElementById("currentEmail");
    var usernameInput = document.getElementById("usernameInput");
    var emailInput = document.getElementById("emailInput");

    if (button.innerText === "Edit") {
        button.innerText = "Save";

        currentUsernameElement.style.display = "none";
        currentEmailElement.style.display = "none";
        usernameInput.style.display = "inline";
        emailInput.style.display = "inline";

        // usernameInput.value = currentUsernameElement.innerText;
        // emailInput.value = currentEmailElement.innerText;
    } else {
        button.innerText = "Edit";

        currentUsernameElement.style.display = "inline";
        currentEmailElement.style.display = "inline";
        usernameInput.style.display = "none";
        emailInput.style.display = "none";

        // currentUsernameElement.innerText = usernameInput.value;
        // currentEmailElement.innerText = emailInput.value;
    }
}
