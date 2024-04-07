<?php
// Connect to your database. Replace with your connection details
$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the recipe content from the form
    $recipeContent = $_POST['recipeContent'];

    // Prepare an SQL statement
    $stmt = $db->prepare("INSERT INTO recipes (content) VALUES (?)");

    // Execute the statement with the recipe content
    $stmt->execute([$recipeContent]);

    // Redirect back to the profile page or wherever you want
    header("Location: profile.php");
}
