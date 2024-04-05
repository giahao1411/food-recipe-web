<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="892034547595-2spm3jb7o4bgqatgpfvccpmkjc0sf78f.apps.googleusercontent.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--CSS here-->
    <link rel="stylesheet" href="./css/logIn_style.css">

    <title>Log in | Register</title>
</head>

<body>



    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="php/signUpVerification.php" method="post" onsubmit="return toogleLeft()">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <div data-onsuccess="onSignIn " class="icon g-signin2"><i class="fa-brands fa-google-plus-g"></i>
                    </div>
                </div>
                <span>or use your email for registeration</span>

                <input type="text" name="username" id="username" placeholder="Username">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password">
                <button id="register-submit" type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="php/loginAuthentication.php" method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <div data-onsuccess="onSignIn " class="icon g-signin2"><i class="fa-brands fa-google-plus-g"></i>
                    </div>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password">

                <?php
                if (isset($_SESSION['signup-success'])) {
                    echo
                    "
                        <div 
                            style='
                                width: 100%;
                                border-radius: 8px;
                                font-size: 0.8rem;
                                text-align: center;
                                align-items: center;
                                padding: 8px 0px;
                                margin: 8px 0px;
                                color: #008000;
                                background-color: #c4f0c4;
                            '> " . $_SESSION['signup-success'] . "
                        </div>
                    ";

                    unset($_SESSION["signup-success"]);
                }
                ?>

                <?php
                if (isset($_SESSION["login-fail"])) {
                    echo
                    "
                        <div 
                            style='
                                width: 100%;
                                border-radius: 8px;
                                font-size: 0.8rem;
                                text-align: center;
                                align-items: center;
                                padding: 8px 0px;
                                margin: 8px 0px;
                                color: #ff0000;
                                background-color: #f6dbdb;
                            '> " .  $_SESSION['login-fail'] . "
                        </div>
                    ";

                    unset($_SESSION["login-fail"]);
                }
                ?>

                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/logIn_script.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>

</html>