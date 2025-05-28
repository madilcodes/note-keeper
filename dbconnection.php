<?php
$con = mysqli_connect('localhost', 'root','');
mysqli_select_db($con, 'project_portal');

if (!$con) {
    echo "Connection failed: " . mysqli_connect_error();
}
?>



