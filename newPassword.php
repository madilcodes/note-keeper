<?php
session_start();
include 'dbconnection.php';
$errors = []; 

if (isset($_SESSION['email'])) {
    $storedEmail = $_SESSION['email'];
    if (isset($_POST['changepassword'])) {

        $storedEmail = $_SESSION['email'];
        $password = $_POST['password'];
        $ConfirmPassword = $_POST['ConfirmPassword'];


        $q = "UPDATE registration_details SET password = '$password', ConfirmPassword = '$ConfirmPassword' WHERE email = '$storedEmail'";
        $result = mysqli_query($con, $q);

        if ($result) {
                session_start();
                $sessionstoredEmail =  $_SESSION['email'];
             
            header('Location: passwordChanged.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
} else {
    echo "Email session variable not set."; 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="password_change_style.css">

    <script>

        function validateForm(event) {
            var pass1 = document.getElementsByName("password")[0].value;
            var pass2 = document.getElementsByName("ConfirmPassword")[0].value;
            if (pass1 !== pass2) {
                alert("Passwords Do Not Match");
                event.preventDefault(); 
            }
        }

    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="newPassword.php" method="POST" autocomplete="off" onsubmit="validateForm(event)">
                    <h2 class="text-center">New Password</h2>

                    <?php
                    if (count($errors) > 0) {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password"
                            required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="ConfirmPassword"
                            placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-success" type="submit" name="changepassword" value="Change">
                        </form>
                <a class="btn btn-danger " href="forgotPassword.php">Back</a>
                    </div>
                
          
        </div>
    </div>

</body>

</html>