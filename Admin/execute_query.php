<?php
include 'dbconnection.php';
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$condition = "event IN ('LOGOUT', 'AUTO LOGOUT') AND logout_time < (NOW() - INTERVAL 1 MINUTE)";
$insertQuery = "INSERT INTO login_details_log SELECT * FROM login_details WHERE $condition";
if ($con->query($insertQuery) === TRUE) {
    $deleteQuery = "DELETE FROM login_details WHERE $condition";
    $result = $con->query($deleteQuery);
}
$con->close();
?>