<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'con.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $event = isset($_POST['event']) ? $_POST['event'] : 'Offline';
    $sql = "UPDATE login_details SET logout_time = NOW(), event='$event' WHERE username = '$username'";
    $query = mysqli_query($con, $sql);
    unset($_SESSION['username']);
} else {
    header("Location: user.php");
}
ob_end_flush();
?>