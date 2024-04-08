<?php

if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $mysqli = connectToDatabase();

    // delete query 
    $sql = "DELETE FROM recipedata WHERE title = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $title);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        deleteSuccess();
    } else {
        deleteFailed();
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $mysqli->close();
}

function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'recipe_description');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

function deleteSuccess()
{
    session_start();

    $_SESSION['delete-successful'] = "Delete successfully, it will take a few minutes to update!";

    header("location: ../index.php");
    exit();
}

function deleteFailed()
{
    session_start();

    $_SESSION['delete-failed'] = "Delete failed, please try again!";

    header("location: ../index.php");
    exit();
}
