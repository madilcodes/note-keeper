<?php
include 'dbconnection.php';
session_start();
$sessionstoredEmail = $_SESSION['email'];

if ($sessionstoredEmail == '') {
    header("Location: forgotPassword.php");
    exit(); 
}

$register_details = "SELECT * FROM registration_details WHERE email='$sessionstoredEmail'";
$run_sql = $con->query($register_details);

if ($run_sql && $run_sql->num_rows > 0) {
    while ($row = $run_sql->fetch_assoc()) {
        $username = $row['Name'];
    }

    $login_details = "SELECT * FROM login_details WHERE username='$username'";
    $result = $con->query($login_details);

    if ($result && $result->num_rows > 0) {
        $q = "UPDATE login_details SET logout_time = NOW(), event='AUTO LOGOUT' WHERE username='$username'";
        $result1 = mysqli_query($con, $q);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="password_change_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">

                <div class="alert alert-success text-center">
                    Your password has been changed. Now you can log in with your new password.
                </div>
                <div class="form-group">
                    <a class="btn btn-success form-control" href='user.php' role="button"> Login Now</a>

                </div>

            </div>
        </div>
    </div>

</body>

</html>