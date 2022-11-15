<?php 
    session_start();

    if(isset($_SESSION['username'])) {
        echo "Username : ".$_SESSION['username'];
        echo "<br>";
        echo "Password : ".$_SESSION['password'];
        echo "<br>";
        echo "Email : ".$_SESSION['email'];
    } else {
        echo "Please login to continue!";
    }
?>