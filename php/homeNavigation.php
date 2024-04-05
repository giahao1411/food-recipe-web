<?php
session_start();

// redirect to home page if user is logged in
if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}
