<?php

// Include database connection file

include_once('.././curdyt/con.php');

if (isset($_POST['email'])) {

  $name = $con->real_escape_string($_POST['name']);
  $mobile = $con->real_escape_string($_POST['mobile']);
  $email = $con->real_escape_string($_POST['email']);
  $otp = mt_rand(1111, 9999);

  $query = "INSERT INTO users (name,email,mobile_number,otp) VALUES ('$name','$email','$mobile','$otp')";

  $result = $con->query($query);

  if ($result) {
    echo "yes";
  } else {
    echo "no";
  }

}
?>