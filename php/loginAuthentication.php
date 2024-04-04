<?php

// handle user authentication
function authenticateUser($email, $password)
{
    $connect = connectToDatabase();
    $hashed_password = retrieveHashedPassword($connect, $email);

    if ($hashed_password !== null) {
        if (validatePassword($password, $hashed_password)) {
            redirectToPage('../test.html');
        } else {
            redirectToPage('../error.html');
        }
    } else {
        redirectToPage('../error.html');
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
function redirectToPage($page)
{
    header("Location: $page");
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // prevent mysqli injection
    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $email = mysqli_real_escape_string($connect, $email);
    $password = mysqli_real_escape_string($connect, $password);

    // Authenticate user
    authenticateUser($email, $password);
}
