<?php
    // start session
    session_start();

    // connect to the database
    require 'connect.php';
    $errors = '';

    // Define errors message
    $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
    $missingPassword = '<p><strong>Please enter a Password!</strong></p>';

    // Get email & password
    if(empty($_POST["loginemail"]))
    {
        $errors .= $missingEmail;
    }
    else
    {
        $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
    }

    if(empty($_POST["loginpassword"]))
    {
        $errors .= $missingPassword;
    }
    else
    {
        $password = htmlspecialchars($_POST["loginpassword"]);
    }

    // IF there are any errors
    if($errors)
    {
        // Error Message
        $resultMessage = '<div class="alert alert-danger">'. $errors .'</div>';
        echo $resultMessage;
    }
    else
    {
        // Prepare variables for the querry
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);
        $password = hash('sha256', $password);

        // Run querry: check combination of email & password exists
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND activation = 'activated'";
        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
        $count = mysqli_num_rows($result);

        if($count !== 1)
        {
            echo '<div class="alert alert-danger">Wrong Username or Password</div>';
            exit;
        }
        else
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            echo 'success';
        }
    }
?>