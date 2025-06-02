<?php
include '../dbconnection.php';
session_start();
$loggedInEmail = ""; 
if (isset($_SESSION['EMAIL'])) {
    $loggedInEmail = $_SESSION['EMAIL'];
}



if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['done'])) {
  $Name = $_POST['Name'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $website = $_POST['website'];
  $message = $_POST['message'];
  
 
  $sql = "INSERT INTO `customer_complaints`(customer_name,email,phonenumber,website,message)VALUES('$Name','$email','$phonenumber','$website','$message')";
  $query = mysqli_query($con, $sql);

  if ($sql) {
    echo "<script>alert('THANK YOU ! WE WILL GET BACK TO YOU SHORTLY .');</script>";

  } else {
    echo "data error: " . mysqli_error($con);
  }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="icon" href="../favicon.jpg" type="image/jpeg">

  <link rel="stylesheet" href="contact_form_style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />




</head>

<body>
  <div class="wrapper">
    <form method="POST">
      <header>Send us a Message</header>
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="Name" placeholder="Enter your name" class="form-control" required>
          <i class='fas fa-user'></i>
        </div>
        <div class="field">
          <input type="text" name="email" placeholder="Enter your email" class="form-control"
            value='<?php echo $loggedInEmail ?>' required>
          <i class='fas fa-envelope'></i>
        </div>
      </div>
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="phonenumber" placeholder="Enter your phone" class="form-control" required>
          <i class='fas fa-phone-alt'></i>
        </div>
        <div class="field">
          <input type="text" name="website" placeholder="Enter your website" class="form-control" required>
          <i class='fas fa-globe'></i>
        </div>
      </div>
      <div class="message">
        <textarea placeholder="Write your message" name="message" class="form-control" required></textarea>
        <i class="material-icons">message</i>
      </div>
      <div class="button-area">
        <a title='Back to Dashboard' href='../Customer/customer_panel.php'>⬅</a>
        <button type="submit" name="done">Send Message</button>


      </div>
    </form>

  </div>
</body>

</html>