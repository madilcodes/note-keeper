<?php
error_reporting(0);
include 'dbconnection.php';
if (isset($_POST['done'])) {
 $username = $_POST['username'];
   $query = "SELECT * FROM `admin_details` WHERE  `username`= '$_POST[username]' AND `password` = '$_POST[password]'";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['admin'] = $username;
    header("location: admin_panel.php");
  } else {
    $error = "Invalid Username Or Password !";

  }

}
?>

<head>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <style>
    .wrapper {
      display: grid;
      place-items: center;
      height: 100vh;
    }

    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    .gradient-custom {
      background: #6a11cb;
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
  </style>


</head>
<div class="container-fluid gradient-custom wrapper">
  <div class="col-lg-4 col-md-6 col-sm-8 px-3 mx-auto bg-dark text-white rounded">
    <form method="POST">
      <div class="mb-md-5 mt-md-4 pb-5 text-center">
        <h2 class="fw-bold mb-2 text-uppercase"> Admin Login</h2>
        <br>
        <div class="row">
          <?php if (isset($error)) { ?>
            <p style="color: red;">
              <?php echo $error; ?>
            </p>
          <?php } ?>
        </div>
        <div class="form-outline form-white mb-4  text-start">
          <label class="form-label" for="typeEmailX">Username</label>
          <input type="text" id="typeEmailX" name="username" class="form-control form-control-lg" required />
        </div>
        <div class="form-outline form-white mb-4 text-start ">
          <label class="form-label" for="typePasswordX">Password</label>
          <input type="password" name="password" autocomplete="current-password" id="id_password"
            class="form-control form-control-lg" required>
          <i class="fa fa-eye text-dark" id="togglePassword" title="view password"
            style="margin-left: 350px; margin-top: -30px; cursor: pointer;"></i>
        </div>
        <?php
        if ($error) { ?>
          <div class="form-outline form-white mb-4 text-start ">
            <a class="small text-white align-items-left " style="text-decoration: none;" href="admin_forgot_password.php"
              title="Reset Your Password">Forgot password ?</a>
          </div>
        <?php } ?>
        <button class="btn btn-outline-warning btn-lg px-5" type="submit" name="done">Login</button>
    </form>
  </div>
  <p class="text-center"> &copy; <?=date("Y")?> Mohd Adil. All rights reserved.</p>
</div>

<script>
  var togglePassword = document.getElementById('togglePassword');
  var password = document.querySelector('#id_password');
  togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });

</script>
