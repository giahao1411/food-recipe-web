<?php
session_start();

if (!isset($_SESSION["login-successful"])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet">

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
                                <h4 style="padding-bottom: 50px;">
                                    <?= $_POST['username'] ?>
                                </h4>
                                <!-- Add Recipe button -->
                                <div class="dashbroad-btn"><a href="#" data-bs-toggle="modal" data-bs-target="#editor">Add Recipe</a></div>
                                <!-- End of Add Recipe button -->
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
                                    <span id="currentUsername">
                                        <?php echo $_POST['username'] ?>
                                    </span>
                                    <input type="text" id="usernameInput" style="display: none;">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <span id="currentEmail">
                                        <?php echo $_POST['email'] ?>
                                    </span>
                                    <input type="text" id="emailInput" style="display: none;">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <button type="button" class="px-4 btn btn-primary" onclick="editProfile()" id="editButton">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 content">
                        <h1 class="m-3 pb-5">Change Password</h1>
                        <div class="col-md-3 m-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                        </div>
                    </div>



                    <div class="card mb-3 content">
                        <h1 class="m-3 pb-5">Recent Activities</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill editor modal -->
    <div class="modal fade" id="editor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Quill editor for text input -->
                    <div id="quillEditor">
                        <h2>Demo Content</h2>
                        <p>Preset build with <code>snow</code> theme, and some common formats.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Quill editor modal -->

    <!-- Password change form modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="savePasswordButton">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Password change form modal -->

    <!--CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>

    <script>
        const quill = new Quill('#quillEditor', {
            theme: 'snow'
        });
    </script>

    <script src="js/edit_profile.js"></script>
    <script src="js/autoSubmitForm.js"></script>

</body>

</html>