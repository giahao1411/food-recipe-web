<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--CSS Here-->
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="topbar">
                <div class="topbar-btn"><a href="php/logOut.php">Log out</a></div>
                <div class='topbar-btn'><a href="php/homeNavigation.php">Home</a></div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="card-body">
                            <img src="imgs/profile-picture.jpg" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4 style="padding-bottom: 50px;">GiaHao</h4>
                                <div class="dashbroad-btn"><a href="php/addRecipe.php">Add Recipe</a></div>
                                <div class="dashbroad-btn"><a href="posts/privacy-policy.php">Privacy Policy</a></div>
                                <div class="dashbroad-btn"><a href="posts/LICENSE.php">License</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-1">
                    <div class="card md-3 content">
                        <h1 class="m-3 pt-3">About</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Username</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    GiaHao
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    abc@gmail.com
                                </div>
                                <div class="col-md-3 mt-3">
                                    <button type="button" class="px-4 btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Edit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-3 content">
                        <h1 class="m-3 pb-5">Recent Activities</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>