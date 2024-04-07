<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrive form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $connect = connectToDatabase();

    if (checkOldPasswordIsMatch($oldPassword, $username) && checkNewPasswordIsMatch($newPassword, $confirmPassword)) {
        $result = updateDatabase($newPassword, $username, $email);

        if ($result) {
            changeSuccessful();
        } else {
            changeError();
        }
    } else {
        changeError();
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

function updateDatabase($newPassword, $username, $email)
{
    $connect = connectToDatabase();

    $hash_newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $deleteQuery = "DELETE FROM userdata WHERE userName = '$username'";
    $insertQuery = "INSERT INTO userdata VALUES ('$username', '$email', '$hash_newPassword')";

    $result1 = $connect->query($deleteQuery);
    $result2 = $connect->query($insertQuery);

    return $result1 && $result2;
}

// check if input is match to the database password
function checkOldPasswordIsMatch($oldPassword, $username)
{
    $connect = connectToDatabase();
    $databasePassword = retrieveHashedPassword($connect, $username);

    // verify the old password against the hashed password in database
    return $databasePassword !== null && password_verify($oldPassword, $databasePassword);
}

function checkNewPasswordIsMatch($newPassword, $confirmPassword)
{
    return $newPassword === $confirmPassword;
}

// retrieve hashed password from database
function retrieveHashedPassword($connect, $username)
{
    $query = "SELECT password FROM userdata WHERE userName = '$username'";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['password'];
    } else {
        return null;
    }
}

function changeSuccessful()
{
    session_start();

    $_SESSION['password-change'] = "Change successfully, it takes a few minutes to update!";

    header("location: ../index.php");
    exit();
}

function changeError()
{
    session_start();

    $_SESSION["password-change-error"] = "Password change failed, please try again";

    header("location: ../index.php");
    exit();
}
