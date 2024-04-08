<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editedEmail = $_POST['emailInput'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connect = connectToDatabase();

    if (validateEmail($editedEmail)) {
        $queryEmail = checkUniqueEmail($connect, $editedEmail);

        // email edited is unique
        if ($queryEmail === null) {
            $result = updateDatabase($username, $editedEmail);

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
    // Validated is wrong
    else {
        emailError();
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
function updateDatabase($username, $editedEmail)
{
    $connect = connectToDatabase();
    $hashed_password = retrieveHashedPassword($connect, $username);

    $deleteQuery = "DELETE FROM userdata WHERE userName = '$username'";
    $insertQuery = "INSERT INTO userdata VALUES ('$username', '$editedEmail', '$hashed_password')";

    $result1 = $connect->query($deleteQuery);
    $result2 = $connect->query($insertQuery);

    return $result1 && $result2;
}

// retrieve hashed password from database
function retrieveHashedPassword($connect, $username)
{
    $query = "SELECT password FROM userdata WHERE username = '$username'";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['password'];
    } else {
        return null;
    }
}

function getBlocklistContent($blocklist_path)
{
    return file($blocklist_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function isDisposableEmail($email)
{
    $blocklist_path = __DIR__ . '/../data/spamEmails/disposable_email_blocklist.conf';
    $disposable_domains = getBlocklistContent($blocklist_path);
    $domain = mb_strtolower(explode('@', trim($email))[1]);
    return in_array($domain, $disposable_domains);
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

    $_SESSION['email-error'] = "Email is invalid!";

    header("location: ../index.php");
    die();
}

function editSuccessful($editedEmail)
{
    session_start();

    $_SESSION['edit-successful'] = $editedEmail;
    $_SESSION['message'] = "Edit successfully, it will take a few minutes to update!";

    header("location: ../index.php");
    die();
}
