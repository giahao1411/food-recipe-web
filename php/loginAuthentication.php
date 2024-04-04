<?php

// handle user authentication
function authenticateUser($email, $password)
{
    $connect = connectToDatabase();
    $hashed_password = retrieveHashedPassword($connect, $email);

    if ($hashed_password !== null) {
        if (validatePassword($password, $hashed_password)) {
            redirectToPage('../index.php');
        } else {
            redirectToErrorPage();
        }
    } else {
        redirectToErrorPage();
    }
}

// connect to the database
function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');

    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }

    return $connect;
}

// retrieve hashed password from database
function retrieveHashedPassword($connect, $email)
{
    $query = "SELECT password FROM userdata WHERE email = '$email'";
    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['password'];
    } else {
        return null;
    }
}

// validate hashed password
function validatePassword($password, $hashed_password)
{
    return password_verify($password, $hashed_password);
}

// redirect user to a page
function redirectToErrorPage()
{
    session_start();
    $_SESSION['login-fail'] = "Email or password is incorrect!";
    header("Location: ../login.php");
    die();
}

function redirectToPage($location)
{
    header("Location: " . $location);
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Authenticate user
    authenticateUser($email, $password);
}
