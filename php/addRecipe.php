<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the recipe content from the form
    $recipeTitle = $_POST['recipeTitle'];
    $recipeContent = $_POST['recipeContent'];
    $image = $_POST['image'];
    $videoLink = $_POST['videoLink'];
}

// Connect to database
function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'login_authentication');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}
