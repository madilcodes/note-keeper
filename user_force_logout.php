<?php
include 'con.php';
$sno = $_GET['sno'];
// $currentDateTime = date('Y-m-d H:i:s');
$updateQuery = "UPDATE login_details SET logout_time = NOW(), event='FORCE LOGOUT' WHERE sno = $sno";
$updateRes = mysqli_query($con, $updateQuery);
if ($updateRes === TRUE) {
    $insertQuery = "INSERT INTO login_details_log SELECT * FROM login_details WHERE sno = $sno";
    if ($con->query($insertQuery) === TRUE) {
        $deleteQuery = "DELETE FROM login_details WHERE sno = $sno";
    }
}
header('location:users_details.php');
?>