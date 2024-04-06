<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Retrieve form data
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    // Authenticate user
    authenticateUser($identifier, $password);
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

function isEmail($identifier)
{
    // if input is email, returns true
    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    // username case returns false
    return false;
}

// retrieve hashed password from database
function retrieveHashedPassword($connect, $identifier)
{
    if (isEmail($identifier)) {
        $query = "SELECT password FROM userdata WHERE email = '$identifier'";
    } else {
        $query = "SELECT password FROM userdata WHERE username = '$identifier'";
    }

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

// handle user authentication
function authenticateUser($identifier, $password)
{
    $connect = connectToDatabase();
    $hashed_password = retrieveHashedPassword($connect, $identifier);

    if ($hashed_password !== null) {
        if (validatePassword($password, $hashed_password)) {
            redirectToPage($identifier);
        } else {
            redirectToErrorPage();
        }
    } else {
        redirectToErrorPage();
    }
}

// redirect user to a page
function redirectToErrorPage()
{
    session_start();
    $_SESSION['login-fail'] = "Email (username) or password is incorrect!";
    header("Location: ../login.php");
    die();
}

function redirectToPage($identifier)
{
    session_start();

    $_SESSION["login-successful"] = '';
    if (isEmail($identifier)) {
        $_SESSION['email'] = $identifier;
        $_SESSION['username'] = getTheRestValue($identifier);
    } else {
        $_SESSION['username'] = $identifier;
        $_SESSION['email'] = getTheRestValue($identifier);
    }

    header("Location: ../index.php");
}

function getTheRestValue($identifier)
{
    if (isEmail($identifier)) {
        $query = "SELECT userName FROM userdata WHERE email = ?";
    } else {
        $query = "SELECT email FROM userdata WHERE userName = ?";
    }

    $connect = connectToDatabase();

    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (isEmail($identifier))
            return $row['userName'];
        return $row['email'];
    } else {
        return null;
    }
}
