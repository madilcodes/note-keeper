<?php

include '../dbconnection.php';
if (isset($_POST['done'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Event = $_POST['event'];

    $registerQuery = "SELECT * FROM `registration_details` WHERE `Name` = '$username' AND `password` = '$password'";
    $registerResult = mysqli_query($con, $registerQuery);
    if (mysqli_num_rows($registerResult) == 1) {
        $loginQuery = "SELECT * FROM `login_details` WHERE `username` = '$username' AND `password` = '$password'";
        $loginResult = mysqli_query($con, $loginQuery);
        if (mysqli_num_rows($loginResult) == 1) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> Agent already logged in.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        } else {
            $insertQuery = "INSERT INTO login_details  (username, password, event) VALUES ('$username', '$password','$Event')";
            $insertResult = mysqli_query($con, $insertQuery);
            if ($insertResult) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("location: user_panel.php");
            }

        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Invalid Username or Password.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}

?>

<head>
    <title> Agent Login Page</title>
    <link rel="icon" href="../favicon.jpg" type="image/jpeg">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .fa {
            padding: 10px;
            text-decoration: none;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-google {
            background: #dd4b39;
            color: white;
        }

        .fa-linkedin {
            background: #007bb5;
            color: white;
        }


        .fa-instagram {
            background: #125688;
            color: white;
        }

        .fa-stumbleupon {
            background: #eb4924;
            color: white;
        }
    </style>
</head>
<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="login form"
                                class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-3 text-black">

                                <form method="post">

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="#" class="fa fa-stumbleupon"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span class="h1 fw-bold mb-0">USER LOGIN</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account
                                    </h5>
                                   
                                    <form method="post">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Username</label>

                                            <input type="text" id="form2Example17" name="username"
                                                class="form-control form-control-lg" required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>

                                            <input type="password" id="form2Example27" name="password"
                                                class="form-control form-control-lg" required />
                                        </div>

                                        <input type="hidden" name="event" value="Online">

                                        <a class="small text-muted" href="forgotPassword.php">Forgot password?</a>
                                        <p class="mb-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                href="../index.php" style="color: #393f81;">Register here</a></p>
                                        <div class="pt-1 mb-4 text-center">
                                            <button class="btn btn-info btn-lg btn-block" type="submit"
                                                name="done">Login</button>
                                        </div>
                                        <div class='text-center'>
                                            <a href="https://www.facebook.com/login/" class="fa fa-facebook"></a>&nbsp;
                                            <a href="https://twitter.com/i/flow/login" class="fa fa-twitter"></a>&nbsp;
                                            <a href="https://accounts.google.com/signin" class="fa fa-google"></a>&nbsp;
                                            <a href="https://www.linkedin.com/login" class="fa fa-linkedin"></a>&nbsp;
                                            <a href="https://www.instagram.com/accounts/login/"
                                                class="fa fa-instagram"></a>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </div>
                                </form>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>