<?php

function isDisposableEmail($email)
{
    $blocklist_path = getEmailBlocklistPath();
    $disposable_domains = getBlocklistContent($blocklist_path);
    $domain = getDomainFromEmail($email);
    return in_array($domain, $disposable_domains);
}

function checkCommonPassword($password)
{
    $blocklist_path = getPasswordBlocklistPath();
    $commonPasswords = getBlocklistContent($blocklist_path);
    return in_array($password, $commonPasswords);
}

function validateSignUpEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) && !isDisposableEmail($email);
}

function validateSignUpPassword($password)
{
    return strlen($password) >= 8 &&
        preg_match('/[A-Z]/', $password) &&
        preg_match('/[a-z]/', $password) &&
        preg_match('/[!@#$%^&*()_+\-=[\]{};\'":\\\\|,.<>\/?]/', $password) &&
        !checkCommonPassword($password);
}

function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

function checkUniqueEmail($connect, $userEmail)
{
    $checkUniqueEmail = "SELECT email FROM userdata WHERE email = ?";
    $stmt = $connect->prepare($checkUniqueEmail);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return $userEmail;
    } else {
        $stmt->close();
        return null;
    }
}

function saveToDatabase($connect, $userName, $userEmail, $userPassword)
{
    $query = "INSERT INTO userdata(userName, email, password) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("sss", $userName, $userEmail, $userPassword);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function getEmailBlocklistPath()
{
    return __DIR__ . '/../data/spamEmails/disposable_email_blocklist.conf';
}

function getPasswordBlocklistPath()
{
    return __DIR__ . '/../data/regularPasswords/common_passwords_list.conf';
}

function getBlocklistContent($blocklist_path)
{
    return file($blocklist_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function getDomainFromEmail($email)
{
    return mb_strtolower(explode('@', trim($email))[1]);
}

function redirectToSuccessPage()
{
    header("Location: ../logIn.html");
    exit();
}

function redirectToErrorPage()
{
    header("Location: ../error.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userName = $_POST["username"];
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];

    $connect = connectToDatabase();

    // validate if true then add to database
    if (validateSignUpEmail($userEmail) && validateSignUpPassword($userPassword)) {
        $queryEmail = checkUniqueEmail($connect, $userEmail);

        // non-existed email
        if ($queryEmail === null) {
            $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $result = saveToDatabase($connect, $userName, $userEmail, $userPassword);

            if ($result) {
                redirectToSuccessPage();
            } else {
                redirectToErrorPage();
            }
        } else {
            redirectToErrorPage();
        }
    } else {
        redirectToErrorPage();
    }
}
