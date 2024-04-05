<?php

function logOut()
{
    $_SESSION['log-out'] = '';
    header("Location: index.php");
}
