<?php
    $con = mysqli_connect('localhost','root','','l&s');
    if(mysqli_connect_error())
    {
        die('Error:Unable to connect' .mysqli_connect_error());
    }
?>