<?php
include '../dbconnection.php';
$id = $_GET['registration_id'];
$q = "DELETE FROM `registration_details` WHERE registration_id = $id";
mysqli_query($con, $q);
header('location:register_details.php');
?>