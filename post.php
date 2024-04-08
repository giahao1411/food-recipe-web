<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];

    $title = getTitle($username);
    $description = getDescription($username);
    $image = getImage($username);
    $link = getLink($username);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PostHub</title>
    <link rel="stylesheet" href="css/postStyle.css">
</head>

<body>
    <div class="blog-card">
        <input type="radio" name="select" id="tap-1" checked />
        <input type="radio" name="select" id="tap-2" />
        <input type="radio" name="select" id="tap-3" />
        <input type="radio" name="select" id="tap-4" />
        <input type="checkbox" id="imgTap" />
        <div class="sliders">
            <label for="tap-1" class="tap tap-1"></label>
            <label for="tap-2" class="tap tap-2"></label>
            <label for="tap-3" class="tap tap-3"></label>
            <label for="tap-4" class="tap tap-4"></label>
        </div>
        <?php
        if (isset($_SESSION["login-successful"])) {
            echo
            "
                <div class='inner-part'>
                    <label for='imgTap' class='img'>
                        <img class='img-1' src='" . $image . "'>
                    </label>
                    <div class='content content-1'>
                        <div class='title'>" . $title . "</div>
                        <div class='text'>" . $description . "</div>
                        <div class='link'>" . $link . "</div>
                        <button onclick='import function()'>Read more</button>
                    </div>
                </div>
            ";
        }
        ?>
        <div class="inner-part">
            <label for="imgTap" class="img">
                <img class="img-2" src="https://images.unsplash.com/photo-1581090700227-1e37b190418e?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzR8fHRlY2hub2xvZ3l8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
            </label>
            <div class="content content-2">
                <span>13 Feb 2020</span>
                <div class="title">Lorem Ipsum Dolor</div>
                <div class="text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum eos
                    ut consectetur numquam ullam fuga animi laudantium nobis rem
                    molestias.
                </div>
                <button>Read more</button>
            </div>
        </div>
        <div class="inner-part">
            <label for="imgTap" class="img">
                <img class="img-3" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTd8fHRlY2hub2xvZ3l8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
            </label>
            <div class="content content-3">
                <span>12 Mar 2021</span>
                <div class="title">Lorem Ipsum Dolor</div>
                <div class="text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                    excepturi nemo commodi sint eum ipsam odit atque aliquam officia
                    impedit.
                </div>
                <button>Read more</button>
            </div>
        </div>
        <div class="inner-part">
            <label for="imgTap" class="img">
                <img class="img-4" src="https://images.unsplash.com/photo-1517433456452-f9633a875f6f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHRlY2hub2xvZ3l8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
            </label>
            <div class="content content-4">
                <span>18 Nov 2021</span>
                <div class="title">Lorem Ipsum Dolor</div>
                <div class="text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                    excepturi nemo commodi sint eum ipsam odit atque aliquam officia
                    impedit.
                </div>
                <button>Read more</button>
            </div>
        </div>
    </div>
</body>

<?php

// Connect to database
function connectToDatabase()
{
    $connect = new mysqli('localhost', 'root', '', 'recipe_description');
    if ($connect->connect_error) {
        die('Connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

function getTitle($username)
{
    $connect = connectToDatabase();
    $query = "SELECT title FROM recipedata WHERE userName = ?";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['title'];
    } else {
        return null;
    }
}

function getDescription($username)
{
    $connect = connectToDatabase();
    $query = "SELECT description FROM recipedata WHERE userName = ?";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['description'];
    } else {
        return null;
    }
}

function getImage($username)
{
    $connect = connectToDatabase();
    $query = "SELECT image FROM recipedata WHERE userName = ?";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['image'];
    } else {
        return null;
    }
}

function getLink($username)
{
    $connect = connectToDatabase();
    $query = "SELECT link FROM recipedata WHERE userName = ?";

    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['link'];
    } else {
        return null;
    }
}
?>

</html>