<?php
session_start();

// redirect to home page if user is logged in
if (isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}
