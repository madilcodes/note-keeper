<?php
require_once "con.php";
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