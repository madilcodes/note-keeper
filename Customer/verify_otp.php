<?php

// Start session   
session_start();

// Include database connection file

include_once('.././curdyt/con.php');

// Send OTP to email Form post
if (isset($_POST['otp'])) {

    $postOtp = $_POST['otp'];
    $email = $_SESSION['EMAIL'];
    $query = "SELECT * FROM users WHERE otp = '$postOtp' AND email = '$email'";

    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $con->query("UPDATE users SET otp = '' WHERE email = '$email'");
        $_SESSION['IS_LOGIN'] = $email;
        echo "yes";
    } else {
        echo "no";
    }
}




?>