<?php

function isDisposableEmail($email, $blocklist_path = null)
{
    if (!$blocklist_path) $blocklist_path = __DIR__ . '/disposable_email_blocklist.conf';
    $disposable_domains = file($blocklist_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $domain = mb_strtolower(explode('@', trim($email))[1]);
    return in_array($domain, $disposable_domains);
}

function checkCommonPassword($password)
{
    $commonPasswords = file("common_passwords_list.txt", FILE_IGNORE_NEW_LINES);

    return in_array($password, $commonPasswords);
}

function validateSignUpEmail($email)
{
    $re = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    if (
        $email === null ||
        strlen(trim($email)) === 0 ||
        !preg_match($re, $email) ||
        isDisposableEmail($email)
    ) {
        return false;
    }
    return true;
}

function validateSignUpPassowrd($password)
{
    if ($password === null || strlen($password) < 8) {
        return false;
    }
    $uppercaseRegex = '/[A-Z]/';
    $lowercaseRegex = '/[a-z]/';
    $specialCharRegex = '/[!@#$%^&*()_+\-=[\]{};\'":\\\\|,.<>\/?]/';
    if (
        !preg_match($uppercaseRegex, $password) ||
        !preg_match($lowercaseRegex, $password) ||
        !preg_match($specialCharRegex, $password) ||
        checkCommonPassword($password)
    ) {
        return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // retrive form data
    $userName = $_POST["username"];
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];

    // connect to database
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');

    // handle the error if connection to database is failed
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }

    // check if email and password is valid
    if (validateSignUpEmail($userEmail) == true && validateSignUpPassowrd($userPassword) == true) {
        // save to database
        $query = "INSERT INTO userdata(userName, email, password) VALUES ('$userName', '$userEmail', '$userPassword')";

        $result = $connect->query($query);

        if ($result->num_rows == 1) {
            header("Location: ./test.html");
            exit();
        } else {
            header("Location: ./error.html");
            exit();
        }
    } else {
        header("Location: error.html");
        exit();
    }
}
