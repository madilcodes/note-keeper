<?php
include "../dbconnection.php";
$errors = []; 
$email = "";
if (isset($_POST['check-email'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = "Please enter the email address!";
    } else {


        $email = $_POST['email'];
    $check_email = "SELECT * FROM registration_details WHERE email='$email'";
   
$run_sql = $con->query($check_email);
      if ($run_sql->num_rows == 1) { 
            session_start();
            $_SESSION['email'] = $email; 
            
            header("location: newPassword.php");
            exit;
        } else {
            $errors['email'] = "This email address does not exist!";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="password_change_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form method="POST" autocomplete="">
                    <h2 class="text-center">Change Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                    if (count($errors) > 0) {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $error) {
                                echo $error;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address"
                            value="<?php echo $email ?>">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success" href="newPassword.php?email=<?php echo $email; ?>" type="submit"
                            name="check-email">Continue</button>
                </form>
                <a class="btn btn-danger " href="user_panel.php">Back</a>
            </div>

        </div>
    </div>
    </div>

</body>

</html>