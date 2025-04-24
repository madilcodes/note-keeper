<?php
include 'con.php';
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
    $comments = $_POST['comments'];

   
    $q = "SELECT * FROM `registration_details` WHERE `email` = '$email'";
    $query = mysqli_query($con, $q);

    if (mysqli_num_rows($query) > 0) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> You have already registered, continue with login!.
      </div>";

    } else {

        $q = "INSERT INTO `registration_details` (`Name`, `email`, `password`, `ConfirmPassword`, `phonenumber`, `gender`, `state`, `city`, `Services`, `comments`) 
              VALUES ('$Name', '$email', '$password', '$ConfirmPassword', '$phonenumber', '$gender', '$state', '$city', '$Services', '$comments')";
            
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
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                alt="Sample photo" class="img-fluid"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                        <div class="col-xl-6">

                            <div class="card-body p-md-2 text-black">
                                <h3 class="mb-5 text-uppercase">registration form</h3>
                                <form id="myForm" method="post" onsubmit="validateForm(event)">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m">Full Name</label>

                                                <input type="text" name="Name" id="form3Example1m"
                                                    class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n">Email</label>

                                                <input type="email" name="email" id="form3Example1n"
                                                    class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m1">Password</label>

                                                <input type="password" name="password" id="form3Example1m1"
                                                    class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n1">Confirm Password</label>

                                                <input type="password" name="ConfirmPassword" id="form3Example1n1"
                                                    class="form-control form-control-lg" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example8">Mobile</label>

                                        <input type="text" name="phonenumber" id="form3Example3"
                                            class="form-control form-control-lg" required />
                                    </div>


                                    <div class="row">
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

                                    <div id="otherBox" style="visibility: hidden;">
                                        State & City: <input name="city" type="text" class="form-control"
                                            placeholder='State & city' />
                                    </div>

                                    <div class="col-md-6 mb-4">

                                        <label class="form-label" for="form3Example1n1">Select Courses</label><br>
                                        <input type="checkbox" name="Services" value="Front-End Development">
                                        <lable for="Services">Front-End Development</lable><br>
                                        <input type="checkbox" name="Services" value="Back-End Development">
                                        <lable for="Services">Back-End Development</lable><br>
                                        <input type="checkbox" name="Services" value="Full Stack Development">
                                        <lable for="Services">Full Stack Development</lable><br>
                                        <input type="checkbox" name="Services" value="Application Development">
                                        <lable for="Services">Application Development</lable><br>
                                        <input type="checkbox" name="Services" value="API Development">
                                        <lable for="Services">API Development</lable><br>
                                        <input type="checkbox" name="Services" value="Data Science">
                                        <lable for="Services">Data Science</lable><br>
                                        <input type="checkbox" name="Services" value="Mobile Development">
                                        <lable for="Services">Mobile Development</lable><br>
                                        <input type="checkbox" name="Services" value="Desktop Development">
                                        <lable for="Services">Desktop Development</lable><br>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example8"> Discription</label>

                                        <input type="text" name="comments" id="form3Example8"
                                            class="form-control form-control-lg" />
                                    </div>


                                    <div class="align-center">
                                        <button type="reset" class="btn btn-info btn-lg">Reset
                                            all</button>
                                        <button type="submit" name="done" id="create"
                                            class="btn btn-warning btn-lg ms-2">Submit Form</button>
                                    </div>
                                </form>

                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a
                                        href="user.php" style="color: #393f81;">Login Here</a></p>
                                <a href="#!" class="small text-muted">Terms of use.</a>
                                <a href="#!" class="small text-muted">Privacy policy</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>