<?php
include 'con.php';


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

    if (isset($_POST['registration_id'])) {
    $userId = $_POST['registration_id'];

    $query = "SELECT password FROM registration_details WHERE registration_id = $userId"; 
    $result = $con->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password = $row['password'];

        echo $password;
    } 
} 


    if (isset($_POST['sno'])) {
    $agentId = $_POST['sno'];

    $query = "SELECT password FROM login_details WHERE sno = $agentId"; 
    $result = $con->query($query);
   
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $agentpassword = $row['password'];

        echo $agentpassword;
    } 
} 


$con->close();
?>