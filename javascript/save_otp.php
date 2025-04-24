<?php
include '.././con.php';
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($_POST['name']) {
  $name = $_POST['name'];
  mysqli_query($con, "INSERT INTO otps(otp) VALUES('" . $name . "')") or die(mysqli_error());
}
?>