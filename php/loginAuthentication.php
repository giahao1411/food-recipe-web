<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // connect to database
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');

    // handle the error if connection to database is failed
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }

    // retrieve hashed password from database
    $query = "SELECT password FROM userdata WHERE email = '$email'";
    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // validate hashed password
        if (password_verify($password, $hashed_password)) {
            // login successful
            header("Location: ../test.html");
            exit();
        } else {
            // login failed
            header("Location: ../error.html");
            exit();
        }
    } else {
        // user not found
        header("Location: ../error.html");
        exit();
    }
}
