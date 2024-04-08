<?php

include 'validatePost.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrive form data
    $username = $_POST['username'];
    $recipeTitle = $_POST['recipeTitle'];
    $recipeContent = $_POST['recipeDescription'];
    $image = $_POST['recipeImageLink'];
    $videoLink = $_POST['recipeVideoLink'];

    $connect = connectToDatabase();
    $check = validateRecipeForm($recipeTitle, $recipeContent, $image, $videoLink);

    // no error detection
    if ($check == null) {
        saveToDatabase($connect, $username, $recipeTitle, $recipeContent, $image, $videoLink);
        deployOnWebsite();
    } else {
        errorControl($check);
    }
}

// Connect to database
function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'recipe_description');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

function saveToDatabase($connect, $username, $recipeTitle, $recipeContent, $image, $videoLink)
{
    $query = "INSERT INTO recipedata(userName, title, description, image, link) VALUES (?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("sssss", $username, $recipeTitle, $recipeContent, $image, $videoLink);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function errorControl($check)
{
    if ($check != null) {
        $_SESSION['error-detect'] = $check;

        header("location: ../index.php");
        exit();
    }
}

function deployOnWebsite()
{
    session_start();

    // start session
    $_SESSION['add-successful'] = 'The recipe description is added';

    header("location: ../index.php");
    exit();
}
