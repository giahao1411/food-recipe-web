<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editedEmail = $_POST['emailInput'];
    $username = $_POST['username'];

    $connect = connectToDatabase();

    if (validateEmail($editedEmail)) {
        $queryEmail = checkUniqueEmail($connect, $editedEmail);

        // email edited is unique
        if ($queryEmail === null) {
            $result = updateToDatabase($username, $editedEmail);

            if ($result) {
                editSuccessful($editedEmail);
            } else {
                emailError();
            }
        }
        // email duplicated
        else {
            emailError();
        }
    }
}

// Connect to database
function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

// Update database 
function updateToDatabase($username, $editedEmail)
{
    $query = "UPDATE userdata SET email = '$editedEmail' WHERE userName = '$username'";
    $connect = connectToDatabase();
    $result = $connect->query($query);

    return $result;
}

// Check if email is valid
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) && !isDisposableEmail($email);
}

// Check unique for email
function checkUniqueEmail($connect, $userEmail)
{
    $checkUniqueEmail = "SELECT email FROM userdata WHERE email = ?";
    $stmt = $connect->prepare($checkUniqueEmail);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return $userEmail;
    } else {
        $stmt->close();
        return null;
    }
}

function emailError()
{
    session_start();

    $_SESSION['email-error'] = "Email existed or contains offensive words!";

    header("location: profile.php");
    die();
}

function editSuccessful($editedEmail)
{
    session_start();

    $_SESSION['edit-successful'] = $editedEmail;
    $_SESSION['message'] = "Updated successfully!";

    header("location: profile.php");
    die();
}
