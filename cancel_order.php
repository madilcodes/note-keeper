<?php
include 'con.php';
$id = $_GET['order_id'];
$q = "DELETE FROM `CustomerOrders` WHERE order_id = $id";
mysqli_query($con, $q);
header('location:../Otpregistration/customer_panel.php');
?>