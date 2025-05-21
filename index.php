<?php
include 'dbconnection.php';
if (isset($_POST['done'])) {
    $Name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $Services = $_POST['Services'];

   
    $q = "SELECT * FROM `registration_details` WHERE `email` = '$email'";
    $query = mysqli_query($con, $q);

    if (mysqli_num_rows($query) > 0) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> You have already registered, continue with login!.
      </div>";

    } else {

        $q = "INSERT INTO `registration_details` (`Name`, `email`, `password`, `ConfirmPassword`, `phonenumber`, `gender`, `state`, `city`, `Services`) 
              VALUES ('$Name', '$email', '$password', '$ConfirmPassword', '$phonenumber', '$gender', '$state', '$city', '$Services')";
            
        $query = mysqli_query($con, $q);

        if ($query) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> YOU HAVE REGISTERED SUCCESSFULLY <a href='user.php'>LOGIN HERE!</a>
          </div> ";
        } 
    }

}
?>

<head>
    <title>Registration Page</title>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script type="text/javascript">
        
        function myfun(data) {
            var req = new XMLHttpRequest();
            req.open("GET", "././states_respons.php?datavalue=" + data, true);
            req.send();
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById("city").innerHTML = req.responseText;
                }
            }
        }
       
        function validateForm(event) {
            var pass1 = document.getElementsByName("password")[0].value;
            var pass2 = document.getElementsByName("ConfirmPassword")[0].value;
            if (pass1 !== pass2) {
                alert("Passwords Do Not Match");
                event.preventDefault(); 
            }
        }

        function otherSelect() {
            var other = document.getElementById("otherBox");
            if (document.forms[0].state.options[document.forms[0].state.selectedIndex].value == "other") {
                other.style.visibility = "visible";
            }
            else {
                other.style.visibility = "hidden";
            }
        }
       </script>
</head>



<section class="h-100 bg-dark">
    <div class="container py-5 ">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="./signup.jpg"
                                alt="Sample photo" class="img-fluid"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                        <div class="col-xl-6">
                            
                            <div class="pr-4 text-black">
                                <h3 class="my-5 text-center text-uppercase">registration form</h3>
                                <form id="myForm" method="post" onsubmit="validateForm(event)">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m">Full Name</label>

                                                <input type="text" name="Name" id="form3Example1m"
                                                    class="form-control form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n">Email</label>

                                                <input type="email" name="email" id="form3Example1n"
                                                    class="form-control form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m1">Password</label>

                                                <input type="password" name="password" id="form3Example1m1"
                                                    class="form-control form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n1">Confirm Password</label>

                                                <input type="password" name="ConfirmPassword" id="form3Example1n1"
                                                    class="form-control form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example8">Mobile</label>
                                            <input type="text" name="phonenumber" id="form3Example3"
                                                class="form-control form-control" required />
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example1n1">Gender:</label>
                                            <select name="gender" class="form-control" 
                                                required>
                                                <option>Select gender</option>
                                                <option> Male </option>
                                                <option> Female </option>
                                                <option> Others </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example1n1">Choose state</label>
                                            <select name="state" class="form-control"
                                                onchange="myfun(this.value); otherSelect();" required>
                                                <option> Select state</option>
                                                <option> Delhi </option>
                                                <option> Assam </option>
                                                <option> Telangana </option>
                                                <option> Gujrat </option>
                                                <option> Goa </option>
                                                <option value="other"> Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example1n1">Choose City</label>
                                            <select name="city" class="form-control" id="city">
                                                <option> Select city </option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        
                                    
                                        <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example1n1">Select Courses</label>
                                            <select name="Services" class="form-control" id="Services">
                                             <option> - Select Courses - </option>
                                            <option value="FrontEnd Development"> FrontEnd Development </option>
                                            <option value="BackEnd Development"> BackEnd Development </option>
                                            <option value="FullStack Development"> FullStack Development </option>
                                            <option value="Application Development"> Application Development </option>
                                            <option value="API Development"> API Development </option>
                                            <option value="Data Science"> Data Science </option>
                                            <option value="Mobile Development"> Mobile Development </option>
                                            <option value="Desktop Development"> Desktop Development </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div id="otherBox" style="visibility: hidden;">
                                            <label class="form-label" for="city">State & City</label>
                                            <input name="city" type="text" class="form-control"
                                                placeholder='State & city' />
                                            </div>
                                        </div>

                                    </div>

                                    <input type="checkbox" name="condition" id="condition"> <label for="condition">  I accept , <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a></label>
                                     
                                    <div class="align-center my-3">
                                        <button type="reset" class="btn btn-info btn">Reset
                                            </button>
                                        <button type="submit" name="done" id="create"
                                            class="btn btn-warning btn ms-2">Register</button>
                                    </div>
                                </form>

                                <p class="pb-lg-2" style="color: #393f81;">Already have an account? <a
                                        href="user.php" style="color: #393f81;">Login Here</a></p>
                                

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>