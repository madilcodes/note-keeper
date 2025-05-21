<?php
include "dbconnection.php";
session_start();
$errors = [];
$email = '';
$phone = '';

if (!isset($_SESSION['email_attempts'])) {
    $_SESSION['email_attempts'] = 0;
}

if (!isset($_SESSION['phone_attempts'])) {
    $_SESSION['phone_attempts'] = 0;
}

if (!isset($_SESSION['phone_lockout_time'])) {
    $_SESSION['phone_lockout_time'] = 0;
}

if (isset($_POST['check-email'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = "Please enter your email address!";
    } else {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM admin_details WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);

        if (mysqli_num_rows($run_sql) != 1) {
            $_SESSION['email_attempts'] += 1;
            $errors['email'] = "This email address does not exist! Attempt " . $_SESSION['email_attempts'] . " of 3.";
            if ($_SESSION['email_attempts'] >= 3) {
                $errors['email'] = "Too many failed attempts. Please try with your phone number.";
            }
        } else {
            $_SESSION['email_attempts'] = 0;
        }
    }
}

if (isset($_POST['check-phone'])) {
    if (empty($_POST['phone'])) {
        $errors['phone'] = "Please enter your phone number!";
    } else {
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $check_phone = "SELECT * FROM admin_details WHERE phone_number='$phone'";
        $run_sql_phone = mysqli_query($con, $check_phone);

        if (mysqli_num_rows($run_sql_phone) != 1) {
            $_SESSION['phone_attempts'] += 1;
            $errors['phone'] = "This phone number does not exist! Attempt " . $_SESSION['phone_attempts'] . " of 3.";
            if ($_SESSION['phone_attempts'] >= 3) {
                $_SESSION['phone_lockout_time'] = time();
                $errors['phone'] = "Too many failed attempts. Please wait for 2 minutes.";
            }
        } else {
            $_SESSION['phone_attempts'] = 0;
        }
    }
}

if (isset($_POST['reset-password'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['NewPassword']);
    $modified_date = date('Y-m-d H:i:s');
    $q = "UPDATE admin_details SET password = '$password',modified_date ='$modified_date' WHERE email = '$email' OR phone_number='$phone'";
    $result = mysqli_query($con, $q);

    if ($result) {
        session_unset(); 
        echo "<script>
                alert('Password changed successfully! Continue with login.');
                window.location.href = 'admin.php';
              </script>";
        exit();
    } else {
        $errors['db-error'] = "Failed to change your password!";
    }
}
?>

<html>

<head>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">
    <title>Admin-Forgot-password</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script> disableInspect();</script>
    <script>
        function validateForm(event) {
            var pass1 = document.getElementsByName("NewPassword")[0].value;
            var pass2 = document.getElementsByName("ConfirmPassword")[0].value;
            if (pass1 !== pass2) {
                alert("Passwords do not match");
                event.preventDefault();
            }
        }

        function checkPhoneLockout() {
            var lockoutTime = <?php echo isset($_SESSION['phone_lockout_time']) ? $_SESSION['phone_lockout_time'] : 0; ?>;
            var currentTime = Math.floor(Date.now() / 1000);
            var remainingTime = (lockoutTime + 120) - currentTime;

            if (remainingTime > 0) {
                var button = document.querySelector('button[name="check-phone"]');
                button.disabled = true;
                var timer = document.getElementById('timer');
                timer.innerText = 'Please wait for ' + remainingTime + ' seconds.';
                var interval = setInterval(function() {
                    remainingTime--;
                    timer.innerText = 'Please wait for ' + remainingTime + ' seconds.';
                    if (remainingTime <= 0) {
                        clearInterval(interval);
                        button.disabled = false;
                        timer.innerText = '';
                        <?php $_SESSION['phone_lockout_time'] = 0; ?>
                    }
                }, 1000);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkPhoneLockout();
        });
    </script>
</head>



<body>

        <div class="col-md-4 offset-md-4 form">
        <div class="card text-center wrapper" style="width: 400px; height: 300px;">
        <div class="card-header h5 text-white bg-primary">Password Reset</div>
                <div class="card-body px-5 bg-dark">
                    <p class="card-text py-2 text-white">Enter your Email or Phone Number.</p>
                    <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger text-center">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" autocomplete="off">
                        <?php if ($_SESSION['email_attempts'] < 3): ?>
                            <div data-mdb-input-init class="form-outline bg-dark">
                                <input type="email" name="email" id="typeEmail" class="form-control my-3" placeholder="Email input" value="<?php echo isset($email) ? $email : ''; ?>" <?php echo isset($run_sql) && mysqli_num_rows($run_sql) == 1 ? 'readonly' : ''; ?>  />
                            </div>
                            <button class="btn btn-primary w-100" type="submit" name="check-email">Check Email</button>
                        <?php else: ?>
                            <div data-mdb-input-init class="form-outline bg-dark">
                                <input type="text" name="phone" id="typePhone" class="form-control my-3" placeholder="Phone number input" value="<?php echo isset($phone) ? $phone : ''; ?>" <?php echo isset($run_sql_phone) && mysqli_num_rows($run_sql_phone) == 1 ? 'readonly' : ''; ?>  />
                            </div>
                            <?php if (!isset($run_sql_phone) || mysqli_num_rows($run_sql_phone) != 1): ?>
                                <button class="btn btn-primary w-100" type="submit" name="check-phone">Check Phone</button>
                            <?php endif; ?>
                      
                            <p id="timer" class="text-white mt-3"></p>
                        <?php endif; ?>

                        <?php if ((isset($run_sql) && mysqli_num_rows($run_sql) == 1) || (isset($run_sql_phone) && mysqli_num_rows($run_sql_phone) == 1)): ?>
                            <input class="form-control" type="password" name="NewPassword" placeholder="New password" required><br>
                            <input class="form-control" type="password" name="ConfirmPassword" placeholder="Confirm password" required><br>
                            <button class="btn btn-primary w-100" type="submit" name="reset-password" onclick="validateForm(event)">Reset password</button>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between mt-4 bg-dark">
                        <a class="btn btn-warning w-10" href="admin.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>
     
</div>
</body>
</html>
