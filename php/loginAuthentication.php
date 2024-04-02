<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // retrive form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // connect to database
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');

    // handle the error if connection to database is failed
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }

    // validate data from userdata
    $query = "SELECT * FROM user_data WHERE email = '$email' AND password = '$password'";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        //login successful
        header("Location: ../test.html");
        exit();
    } else {
        //login failed
        header("Location: ../error.html");
        exit();
    }
}
