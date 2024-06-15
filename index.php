<?php
    session_start();
    require 'lib/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Singup Form</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital," rel="stylesheet">

    <!-- jQuery Library CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    
    
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
                    <img src="img/creastive new.png" alt="" style="width:200px;height:50px;" class="img-fluid p-2">
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
        
    </main>

<!-- Login Form -->
    <form method="post" id="loginform">
        <div class="modal fade" id="loginModal" tabindex="-1" data-bs-backdrop="static" dat-bs-keyboard="false" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header d-flex flex-column">
                        <img src="img/creastive new.png" alt="" style="width:200px;height:50px;" class="img-fluid p-2">
                        <h4 class="modal-title fw-bold mt-4">
                            Continue with Login In
                        </h4>
                    </div>
                    <div class="modal-body px-5 py-5">
                        <div id="loginmessage"></div>
                        <div class="mb-4">
                            <input type="email"
                            class="form-control" placeholder="Email Address" name="loginemail" id="loginemail" aria-describedby="emailId">
                        </div>
                        <div class="mb-3">
                            <input type="password"
                            class="form-control" placeholder="Password" name="loginpassword" id="loginpassword"
                            >
                        </div>
                        <div>
                            <a href="#" class="float-end text-decoration-none text-white fw-bold"
                            data-bs-toggle="modal" data-bs-dismiss="modal"
                            data-bs-target="#forgetpasswordModal">Forgot Password</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg w-100 rounded-4">Sign In</button>
                    </div>
                    <h6 class="text-center fw-bold">Don't have an Account?<a href="" class=" text-decoration-none text-white ps-2">Sign Up</a></h6>
                </div>
            </div>
        </div>
    </form>

<!-- Sign up Form -->
<form method="post" id="signupform">
        <div class="modal fade" id="signupModal" tabindex="-1" data-bs-backdrop="static" dat-bs-keyboard="false" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header d-flex flex-column">
                        <img src="img/creastive new.png" alt="" style="width:200px;height:50px;" class="img-fluid p-2">
                        <h4 class="modal-title fw-bold mt-4">
                            Continue with Sign Up
                        </h4>
                    </div>
                    <div class="modal-body px-5 py-5">
                        <div id="signupmessage"></div>
                        <div class="mb-4">
                            <input type="text"
                            class="form-control" placeholder="User Name" name="username" id="username">
                        </div>
                        <div class="mb-4 row">
                            <div class="col-6">
                                <input type="text"
                                class="form-control" placeholder="First Name" name="firstname" id="firstname">
                            </div>
                            <div class="col-6">
                                <input type="text"
                                class="form-control" placeholder="Last Name" name="lastname" id="lastname">
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="email"
                            class="form-control" placeholder="Email Address" name="email" id="email" aria-describedby="emailId">
                        </div>
                        <div class="mb-4">
                            <input type="password"
                            class="form-control" placeholder="Password" name="password" id="password">
                        </div>
                        <div class="mb-4">
                            <input type="password"
                            class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                        </div>
                        <div class="mb-4">
                            <input type="text"
                            class="form-control" placeholder="Phone Number" name="phonenumber" id="phonenumber">
                        </div>
                        <div>
                            <a href="#" class="float-end text-decoration-none text-white fw-bold"
                            data-bs-toggle="modal" data-bs-dismiss="modal"
                            data-bs-target="#forgetpasswordModal">Forgot Password</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg w-100 rounded-4" name="signup">Sign Up</button>
                    </div>
                    <h6 class="text-center fw-bold">Already have an account? Login In<a href="" class=" text-decoration-none text-white ps-2">Sign Up</a></h6>
                </div>
            </div>
        </div>
    </form>

    <div id="spinner">
        <img src="./img/ajax-loader.gif" alt="ajax" width="64" height="64">
        <br>Loading......
    </div>
    

    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>