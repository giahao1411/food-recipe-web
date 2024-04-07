<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrive form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $connect = connectToDatabase();

    if (checkOldPasswordIsMatch($oldPassword, $username) && checkNewPasswordIsMatch($newPassword, $confirmPassword, $username)) {
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

function checkOldPasswordIsMatch($oldPassword, $username)
{
    $connect = connectToDatabase();
    $inDatabasePassword = retrieveHashedPassword($connect, $username);
    $inputPassword = password_hash($oldPassword, PASSWORD_DEFAULT);

    if ($inDatabasePassword == $inputPassword)
        return true;
    return false;
}

function checkNewPasswordIsMatch($newPassword, $confirmPassword, $username)
{
    if ($newPassword == $confirmPassword)
        return true;
    return false;
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

function changeSuccessful()
{
    session_start();

    $_SESSION['password-change'] = "Change successfully, it takes a few minutes to update!";

    header("location: ../index/php");
    die();
}

function changeError()
{
    session_start();

    $_SESSION["password-change-error"] = "Your password is incorrect!";

    header("location: ../index.php");
    die();
}
