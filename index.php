<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CDN Here-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--CSS here-->
    <link rel="stylesheet" href="css/style.css">

    <!--Link image-->
    <link rel="icon" type="image/x-icon" href="/imgs/Recipes Logo.svg">

    <title>Home | Sweet Tooth</title>
</head>

<body>
    <header>
        <div class="row">
            <h1>Sweet Tooth</h1>
            <div class="get-started">
                <ul>
                    <li>
                        <?php
                        if (!empty($_SESSION['email'])) {
                            echo
                                " 
                                    <form id='hidden-form' method='post' action='./profile.php'>
                                        <input type='hidden' id='username' name='username' value='" . $_SESSION['username'] . "'>
                                        <input type='hidden' id='email' name='email' value='" . $_SESSION['email'] . "'>

                                        <button type='submit' class='rounded-circle' style='border: none;'>
                                            <i class='fa fa-user-circle' aria-hidden='true' style='
                                                                font-size: 1.6rem;
                                                                color: #fff;
                                                '>
                                            </i>
                                        </button>
                                    </form>
                                ";
                        } else {
                            echo "<a href='login.php'>Get Started</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="search">
            <input type="text" id="searchInput" placeholder="Enter an ingredient...">
            <button id="searchButton">Search</button>
        </div>

    </header>

    <div id="mealList" class="meal-list"></div>
    <div class="modal-container">
        <button id="recipeCloseBtn" class="close-button">&times;</button>
        <div class="meal-details-content">
            <!-- Content from js will be inserted here -->
        </div>
    </div>

    <script src="js/script.js"></script>

</body>

</html>