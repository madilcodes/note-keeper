<?php
include '../dbconnection.php';
$sno = $_GET['sno'];
$updateQuery = "UPDATE login_details SET logout_time = NOW(), event='FORCE LOGOUT' WHERE sno = $sno";
if (mysqli_query($con, $updateQuery)) {
    $insertQuery = "INSERT INTO login_details_log SELECT * FROM login_details WHERE sno = $sno";
    if (mysqli_query($con, $insertQuery)) {
        $deleteQuery = "DELETE FROM login_details WHERE sno = $sno";
        mysqli_query($con, $deleteQuery);
    }
}
header('location:users_details.php');
?>