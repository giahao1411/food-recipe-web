<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrive form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $connect = connectToDatabase();
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

function checkOldPasswordIsMatch($oldPassword, $username)
{
    
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
