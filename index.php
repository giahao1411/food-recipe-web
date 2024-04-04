<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS here-->
    <link rel="stylesheet" href="./css/style.css">

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

                        if (isset($_SESSION['user'])) {
                            echo
                            "
                                <div>
                                    
                                </div>
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