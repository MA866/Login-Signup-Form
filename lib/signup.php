<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'cred.php';


    // Sart Session
    session_start();
    require 'connect.php';
    $errors='';

    //  Check user input
    // Error Messages

    $missingUsername = '<p><strong>Please enter a username!</strong></p>';
    $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
    $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
    $missingPassword = '<p><strong>Please enter a Password!</strong></p>';
    $invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
    $differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
    $missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
    $missingfirstname = '<p><strong>Please enter your firstname!</strong></p>';
    $missinglastname = '<p><strong>Please enter your lastname!</strong></p>';
    $missingPhone = '<p><strong>Please enter your phone number!</strong></p>';
    $invalidPhoneNumber = '<p><strong>Please enter a valid phone number (digits only and less than 15 long)!</strong></p>';
    $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';


    // Get Form input
    // Get Username
    if(empty($_POST["username"]))
    {
        $errors .= $missingUsername;
    }
    else
    {
        $username = htmlspecialchars($_POST["username"]);
    }

    // Get Firstname
    if(empty($_POST["firstname"]))
    {
        $errors .= $missingfirstname;
    }
    else
    {
        $firstname = htmlspecialchars($_POST["firstname"]);
    }

    // Get Firstname
    if(empty($_POST["lastname"]))
    {
        $errors .= $missinglastname;
    }
    else
    {
        $lastname = htmlspecialchars($_POST["lastname"]);
    }

    // Get Email
    if(empty($_POST["email"]))
    {
        $errors .= $missingEmail;
    }
    else
    {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors .= $invalidEmail;
        }
    }

    // Get Password
    if(empty($_POST["password"]))
    {
        $errors .= $missingPassword;
    }
    elseif(!(strlen($_POST["password"]) > 6 and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"])))
    {
        $errors .= $invalidPassword;
    }
    else
    {
        $password = htmlspecialchars($_POST["password"]);
        if(empty($_POST["confirm_password"]))
        {
            $errors .= $missingPassword2;
        }
        else
        {
            $password2 = filter_var($_POST["confirm_password"]);
            if($password !== $password2)
            {
                $errors .= $differentPassword;
            }
        }
    }

    // Get Phone Number
    if(empty($_POST["phonenumber"]))
    {
        $errors .= $missingPhone;
    }
    elseif(preg_match('/\D/',$_POST["phonenumber"]))
    {
        $errors .= $invalidPhoneNumber;
    }
    else
    {
        $phonenumber = htmlspecialchars($_POST["phonenumber"]);
    }

    // If there are any errors print error
    if($errors)
    {
        $resultMessage = '<div class="alert alert-link text-danger fs-5">'. $errors .'</div>';
        echo $resultMessage;
        exit;
    }

    // No errors
    // Prepare of the variable to query
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    if(!$result)
    {
        echo '<div class="alert alert-danger>Error Runing in the querry!</div>'; exit;
    }

    $results = mysqli_num_rows($result);
    if($results)
    {
        echo '<div class="alert alert-danger">That email is already registered. Please log in?</div>';  exit;
    }

    // Create a uniqe activation code
    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));

    // Insert user detailes and activation code in the user tables
    $sql =  "INSERT INTO users (`first_name`, `last_name`, `username`, `email`, `password`, `activation`, `phonenumber`) VALUES ('$firstname', '$lastname', '$username', '$email', '$password',	'$activationKey', '$phonenumber')";
    $result = mysqli_query($con, $sql);
    if(!$result)
    {
        echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>';  exit;
    }

    //Send the user an email with a link to activate.php with their email and activation code
    $message = "Please click on this link to activate your Account:\n\n";
    $message .= "http://localhost:3000/lib/activate.php?email=" . urlencode($email) . "&key=$activationKey";


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = MYEMAIL;                     //SMTP username
        $mail->Password   = MYPASS;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(MYEMAIL, 'Mahi Singh');
        $mail->addAddress($email, $firstname);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo(MYEMAIL, 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Confirm your Registration';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email.Please click on the activation account to activated your account.</div>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>  