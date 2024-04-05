<?php
// start session
session_start();

// unset all of the session variables
session_unset();
session_destroy();

// redirect to home page
header("Location: ../index.php");
exit();
