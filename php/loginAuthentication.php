<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // retrive form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "login_authentication";

    // connect to database
    $connect = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // handle the error if connection to database is failed
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }

    // validate data from userdata
    $query = "SELECT * FROM user_data WHERE email = ? AND password = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        //login successful
        header("Location: test.html");
        exit();
    } else {
        //login failed
        header("Location: error.html");
        exit();
    }
}
