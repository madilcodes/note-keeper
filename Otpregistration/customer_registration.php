<?php
include '.././curdyt/con.php';


if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $subscribe = isset($_POST['subscribe']) && $_POST['subscribe'] === 'Y' ? 'Y' : 'N';

    $q = "SELECT * FROM `customer_registrations` WHERE `email` = '$email'";
    $query1 = mysqli_query($con, $q);

    if (mysqli_num_rows($query1) > 0) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> Email already exists! .<a href='customer_login.php'>LOGIN HERE!</a>
      </div>";

    } else {

      
        $q = "INSERT INTO `customer_registrations` (`first_name`,`last_name`, `email`, `password`,`subscribe`) 
              VALUES ('$firstname','$lastname', '$email', '$password','$subscribe');";
            
        $query = mysqli_query($con, $q);

        if ($query) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> You have Registered successfully . <a href='customer_login.php'>LOGIN HERE!</a>
          </div> ";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
           <strong>Error!</strong>Failed to register. Please try again!.
         </div>";
        }
    }


}
    ?>

<head>

   <title>cutomer sign up</title>
   <link rel="icon" href=".././curdyt/favicon.jpg" type="image/jpeg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 100px;
        "></div>
    <!-- Background image -->


    <div class="card-body py-5 px-md-5">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <h2 class="fw-bold mb-5">Sign up now</h2>
                <form method="post">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label float-left" for="form3Example1">First name</label>

                                <input type="text"  name='firstname' id="form3Example1" class="form-control"  required/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label float-left"  for="form3Example2">Last name</label>

                                <input type="text" id="form3Example2"  name='lastname' class="form-control" required/>
                            </div>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label float-left" for="form3Example3">Email address</label>

                        <input type="email" id="form3Example3" name='email' class="form-control" required />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label float-left" for="form3Example4">Password</label>

                        <input type="password" id="form3Example4" name='password' class="form-control" required />
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <label class="form-check-label" for="form2Example33">

                            <input class="form-check-input me-2" type="checkbox" name="subscribe" value="Y" id="form2Example33" checked />
                            Subscribe to our newsletter
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit"  name='submit' class="btn btn-primary btn-block mb-4">
                        Sign up
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Alredy have Account<a href='customer_login.php'>  LOGIN HERE!</p>
                        <p>or sign up with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fa fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fa fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fa fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fa fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Section: Design Block -->