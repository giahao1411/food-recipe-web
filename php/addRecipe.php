<?php

include 'validatePost.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrive form data
    $recipeTitle = $_POST['recipeTitle'];
    $recipeContent = $_POST['recipeDescription'];
    $image = $_FILES['recipeImage']['size'];
    $videoLink = $_POST['recipeVideoLink'];

    $connect = connectToDatabase();
    $check = validateRecipeForm($recipeTitle, $recipeContent, $image, $videoLink);

    // no error detection
    if ($check == null) {
        saveToDatabase($connect, $recipeTitle, $recipeContent, $image, $videoLink);
        deployOnWebsite($recipeTitle, $recipeContent, $image, $videoLink);
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

function saveToDatabase($connect, $recipeTitle, $recipeContent, $image, $videoLink)
{
    $query = "INSERT INTO recipedata(title, description, image, link) VALUES (?, ?, ?, ?)";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssss", $recipeTitle, $recipeContent, $image, $videoLink);
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

function deployOnWebsite($recipeTitle, $recipeContent, $image, $videoLink)
{
    session_start();

    // start session
    $_SESSION['add-successful'] = 'The recipe description is added';
    $_SESSION['recipe-title'] = $recipeTitle;
    $_SESSION['recipe-content'] = $recipeContent;
    $_SESSION['recipe-image'] = $image;
    $_SESSION['recipe-video-link'] = $videoLink;

    header("location: ../index.php");
    exit();
}
