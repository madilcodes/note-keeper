<?php
include 'con.php';
$id = $_GET['order_id'];
$q = "DELETE FROM `coffee_orders` WHERE order_id = $id";
mysqli_query($con, $q);
header('location:coffee_orders.php');
?>