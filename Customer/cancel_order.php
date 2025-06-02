<?php
include '../dbconnection.php';
$id = $_GET['order_id'];
$q = "DELETE FROM `customer_orders` WHERE order_id = $id";
mysqli_query($con, $q);
header('location:../Customer/customer_panel.php');
?>