<?php
    session_start();
    require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Singup Form</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital," rel="stylesheet">

    <!-- jQuery Library CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon ">
                    </span>
                </button>
                <div class="offcanvas offcanvas-start" id="offcanvasNavId">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                        <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-center" href="#">Recently Add Images</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link text-center" href="#">Lifstyle</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link text-center" href="#">Beauty & fashion</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="#">Health & Fitness</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <img src="../img/creastive new.png" alt="" style="width:200px;height:50px;" class="img-fluid p-2">
                </div>
                
                <div>
                    <!-- Login Form -->
                    <button type="button" class="btn btn-dark rounded-5 py-1" data-bs-toggle="modal" data-bs-target="#loginModal">Login in</button>

                    <!-- SignUp Form -->
                    <button type="button" class="btn btn-dark rounded-5 py-1 " data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center bg-light">
                <div class="col-lg-10 col-sm-5">
                    <div class="mt-5 text-center">
                        <h1 class="text-dark">Account Activation!</h1>
                        <?php
                            // If email or activation key is missing show in error
                            if(!isset($_GET['email']) || !isset($_GET['key']) )
                            {
                                echo '<div class="alert alert-danger>There was an error. Please click on the activation link you received by email.</div>'; exit;
                            }
                            // else
                            // Store in two variables
                            $email = $_GET['email'];
                            $key = $_GET['key'];

                            // prepare variables to query
                            $email = mysqli_real_escape_string($con, $email);
                            $key = mysqli_real_escape_string($con, $key);

                            // Run query: set activation filed to activated for the provided email
                            $sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
                            $result = mysqli_query($con, $sql);

                            // if query succesfull then invite user to login
                            if(mysqli_affected_rows($con) == 1)
                            {
                                echo '<div class="alert alert-success">Your Account has been Activated</div>';
                                echo  '<a href="/index.php" type="button" class="btn-lg btn-success">Log in</a>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
                                echo '<div class="alert alert-danger>'. mysqli_error($con) .'</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="spinner">
        <img src="../img/ajax-loader.gif" alt="ajax" width="64" height="64">
        <br>Loading......
    </div>
    

    <script src="../css/bootstrap.min.css"></script>
    <script src="../js/script.js"></script>
</body>
</html>