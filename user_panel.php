<?php
session_start();
include 'dbconnection.php';
$username = $_SESSION['username'];
if ($username == '') {
  header("Location: user.php");
}

if (isset($_POST['submit'])) {
  $name = $_SESSION['username'];
  $message = $_POST['message'];
  $q = "INSERT INTO users_messages (agent_name, message,flag) VALUES ('$name', '$message','0')";
  echo $q;
  $query = mysqli_query($con, $q);
}

$chat = "SELECT * FROM users_messages where agent_name='$username'";
$result = mysqli_query($con, $chat);
while ($row = mysqli_fetch_assoc($result)) {

  $message = $row['message'];
  $timestamp = $row['entry_date'];
  $converttime = date("h:i A", strtotime($timestamp));
}

$admin = "SELECT * FROM admin_messages where agent_name='$username'";
$result1 = mysqli_query($con, $admin);
while ($row = mysqli_fetch_assoc($result1)) {

  $adminmsg = $row['message'];
  $time = $row['entry_date'];
  $formattedTime = date("h:i A", strtotime($time));
}
    
if ($username) {

  $show = "SELECT * FROM registration_details WHERE Name = '$username'";
  $result = mysqli_query($con, $show);
  $userData = mysqli_fetch_assoc($result);

}

if (isset($_POST['save'])) {

  $username = $_SESSION['username'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $gender = $_POST['gender'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $update_record = "UPDATE registration_details SET  email='$email', phonenumber='$phonenumber', gender='$gender',state='$state',city='$city' WHERE Name='$username' ";
  $query = mysqli_query($con, $update_record);
  if ($query) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Success!</strong> Your Profile has been Updated!
                      </div>";
  }
}


$q = "SELECT * FROM users_complaints  where agent_name='$username'";

// $query = mysqli_query($con, $q);
$result2 = $con->query($q);

$Open_orders = "SELECT * FROM Customer_Orders where agent='$username' AND order_status='' limit 1";
$open_result = $con->query($Open_orders);

$Closed_orders = "SELECT * FROM Customer_Orders where agent='$username' AND   order_status!=''";
$result4 = $con->query($Closed_orders);

if (isset($_POST['upload'])) {
  $order_Id = $_POST['order_id'];
  $order_Status = $_POST['order_status'];

  $query3 = "UPDATE Customer_Orders SET order_status ='$order_Status' WHERE order_id='$order_Id'";
  $result3 = mysqli_query($con, $query3);

  if ($result3) {
    echo '<div class="alert alert-primary" role="alert">
          Order no: ' . $order_Id . ' status has been updated as ' . $order_Status . '.
         
      </div>';
  }
}

$query = "SELECT profile_pic FROM registration_details WHERE Name = '$username'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$profile_pic = $row ? $row['profile_pic'] : 'default.jpg';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>USER-PANEL</title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .open-button {
      background-color: #555;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      bottom: 23px;
      right: 28px;
      width: 280px;
    }


    .chat-popup {
      display: none;
      position: fixed;
      bottom: 0;
      right: 15px;
      border: 3px solid #f1f1f1;
      z-index: 9;
    }


    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }


    .form-container textarea {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
      resize: none;
      min-height: 200px;
    }


    .form-container textarea:focus {
      background-color: #ddd;
      outline: none;
    }


    .form-container .btn {
      background-color: #04AA6D;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom: 10px;
      opacity: 0.8;
    }


    .form-container .cancel {
      background-color: red;
    }

    .profile-pic img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 15px;
    }




    .form-container .btn:hover,
    .open-button:hover {
      opacity: 1;

    }

    .custom-file-upload {
      display: inline-block;
      padding: 8px 12px;
      cursor: pointer;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 14px;
      text-align: center;
    }

    .custom-file-upload:hover {
      background-color: #0056b3;
    }

    input[type="file"] {
      display: none;
    }
  </style>
  <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }

    function openWindow() {
      window.open("./javascript/javascript_ajax.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=400,left=400,width=300,height=300");
    }

    function togglePasswordVisibility() {
      const passwordField = document.getElementById('city');
      const toggleIcon = document.getElementById('toggleIcon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }

  </script>

</head>

<div class="header">
  <h1 class='text-center'>WELCOME <?= strtoupper($username); ?></h1>
  <div>
    <div class="card-body">

      <div class="modal fade" id="view_profile_Avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">

          <div class="modal-content">

            <div class="modal-body text-center mb-1">
              <div class="profile-pic">

                <img id="profileImage" src="uploads/<?php echo !empty($profile_pic) ? $profile_pic : 'default.jpg'; ?>"
                  alt="Profile Picture">
              </div>
              <h5 class="mt-1 mb-2">HEY <?= strtoupper($username) ?></h5>
              <div class="md-form mb-5 text-left">
                <i class="fa fa-envelope prefix grey-text"></i>
                <label data-error="wrong" for="username">Your Username</label>
                <input type="text" id="username" name='username' class="form-control validate"
                  value="<?php echo $_SESSION['username']; ?>" readonly>
              </div>
              <div class="md-form ml-0 mr-0 text-left">
                <i class="fa fa-user prefix grey-text"></i>

                <label data-error="wrong" for="password">Your Password</label>
                <div style="position: relative;">

                  <input type="password" id="password" class="form-control validate" name="password"
                    value="<?php echo $_SESSION['password']; ?>" readonly style="padding-right: 40px;">
                  <span onclick="togglePasswordVisibility()"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                    <i title="view password" id="toggleIcon" class="fa fa-eye"></i>
                  </span>
                </div>
              </div>
              <div class="text-center mt-4">


                <a class="btn btn-info" title='Update-Password' href="forgotPassword.php">Update</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal fade" id="edit_profile_Avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
          <div class="modal-content">
            <!-- <div class="modal-header"> -->
            <div class="modal-body text-center mb-1">

              <div class="profile-pic">

                <img id="profileImage" src="uploads/<?php echo !empty($profile_pic) ? $profile_pic : 'default.jpg'; ?>"
                  alt="Profile Picture">

                <form id="uploadForm" method="POST" enctype="multipart/form-data" action="./user_profile_upload.php">
                  <input type="hidden" name="username1" value="<?php echo $username; ?>">
                  <label for="profile_pic" class="custom-file-upload">Edit Profle</label>
                  <input id="profile_pic" type="file" name="profile_pic" accept="image/*" required>

                  <button class="btn-primary btn fa fa-upload text-light" title="Update profile-pic"
                    type="submit"></button>
                  <button class="btn-danger btn fa fa-trash text-light" title="Remove profile-pic" type="button"
                    id="removeBtn"></button>
                </form>
              </div>
              <p>Update Your Profile</p>
            </div>

            <div class="modal-body text-center mb-1">
              <!-- <h5 class="mt-1 text-bold">Update Your Profile</h5> -->
              <form method='post'>

                <div class="md-form mb-5 text-left">


                  <label data-error="wrong" for="username">Username</label>
                  <input type="text" id="Name" name='Name' class="form-control validate"
                    value="<?php echo $userData['Name']; ?>" readonly>
                  <label data-error="wrong" for="email">Email</label>
                  <input type="email" id="email" class="form-control validate" name='email'
                    value="<?php echo $userData['email']; ?>">
                  <label  for="mobile">Mobile</label>
                  <input type="text" id="mobile" class="form-control validate" name='phonenumber'
                    value="<?php echo $userData['phonenumber']; ?>">
                  <label  for="gender">Gender</label>
                  <input type="text" id="gender" class="form-control validate" name='gender'
                    value="<?php echo $userData['gender']; ?>">
                  <label  for="state">State</label>
                  <input type="text" id="state" class="form-control validate" name='state'
                    value="<?php echo $userData['state']; ?>">
                  <label  for="city">City</label>
                  <input type="text" id="city" class="form-control validate" name='city'
                    value="<?php echo $userData['city']; ?>">

                </div>
                <div class="text-center mt-4">
                  <input class="btn btn-info" type="submit" name='save' value='Save' title='Save changes'></input>

                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <form method='post'>
        <a type='submit' class="btn btn-success btn-rounded text-light " name='updateProfile' data-toggle="modal"
          data-target="#edit_profile_Avatar" title='update your profile'>Edit profile</a>
        <a class="btn btn-warning btn-rounded text-light " data-toggle="modal" data-target="#view_profile_Avatar"
          title="View Your Profile">View profile</a>&nbsp;&nbsp;

        <a type="button" class='btn btn-secondary text-light' title="Raise Your Complains" onclick="openWindow()">Raise
          Complain</a>

        <button type="submit" name="logout" class='btn btn-danger fa fa-sign-out float-right' title="Logout"
          id="logoutButton">Logout</button>

        <a type="button" class='btn btn-primary fa fa-spinner float-right' title="Refresh" href="user_panel.php"
          value="Refresh">Refresh</a>

      </form>
    </div><br>
    <div>
      <button type="button" title='View complaints' class="btn btn-primary" data-toggle="modal"
        data-target=".bd-example-modal-lg">View
        Issues</button>

      <button type="button" title='Open Orders' class="btn btn-danger" data-toggle="modal"
        data-target=".bd-example-modal-lg1">Open Orders</button>
      <button type="button" title='All Orders' class="btn btn-success" data-toggle="modal"
        data-target=".bd-example-modal-lg3">Closed Orders</button>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
      aria-hidden="true">


      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <h4 class='text-center'><b> User's Complaints</b></h4>

          <table class="table table-bordered ">
            <thead>
              <tr class='bg-success '>
                <th>Sno</th>
                <th>User</th>
                <th>Complaints </th>
                <th>Created On</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sno = 1;
         
                 while ($res = $result2->fetch_assoc()) {
                ?>
                <tr>
                  <td>
                    <?php echo $sno; ?>
                  </td>
                  <td>
                    <?php echo $res['agent_name']; ?>
                  </td>
                  <td>
                    <?php echo $res['message']; ?>
                  </td>
                  <td>
                    <?php echo $res['entry_date']; ?>
                  </td>
                </tr>
                <?php
                $sno++;
              }
              ?>
            </tbody>
          </table>
          <div class='text-center'>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
      aria-hidden="true">


      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:1000px;">

          <form method='post'>


            <h4 class='text-center'><b> Open Orders</b></h4>

            <table class="table table-bordered bg-secondary;">

              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Details</th>
                  <th>Entry Date</th>
                  <th>Address</th>
                  <th>Store Name</th>
                  <th>All Items</th>
                  <th>Delivery Agent </th>
                  <th>Order Status</th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>

                <?php
                if ($open_result->num_rows > 0) {
                  while ($row = $open_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='hidden' name='order_id' value='{$row['order_id']}'>{$row['order_id']}</td>";
                    $contact_details = "{$row['full_name']} ,{$row['email']},{$row['phone_number']}";
                    echo "<td>{$contact_details}</td>";
                    echo "<td>{$row['order_date']}</td>";
                    $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";
                    echo "<td>{$address}</td>";
                    echo "<td>{$row['stores']}</td>";
                    $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                    echo "<td>{$products}</td>";
                    echo "<td>{$row['agent']}</td>";
                    echo "<td>";
                    if ($row['order_status'] === null || $row['order_status'] === '') {
                      echo "<select name='order_status' required>";
                      echo "<option value=''>Select status</option>";
                      echo "<option value='delivered'>Delivered</option>";
                      echo "<option value='wrong Customer details'>Wrong Customer details</option>";
                      echo "<option value='cancelled_by_customer'>Cancelled by customer</option>";
                      echo "</select>";
                    } else {
                      echo "{$row['order_status']}";
                    }

                    echo "</td>";
                    echo "<td><button type='submit'  class=' btn fa fa-save btn-success' name='upload'></button></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<td colspan='9' style='color: red; text-align:center;'> No orders found .</td>";
                }
                ?>


              </tbody>
          </form>
          </table>
          <div class='text-center'>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
      aria-hidden="true">


      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <form method='post'>
            <h4 class='text-center'><b> Closed Orders</b></h4>
            <table class="table table-bordered ">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Details</th>
                  <th>Entry Date</th>
                  <th>Address</th>
                  <th>Store Name</th>
                  <th>All Items</th>
                  <th>Delivery Agent </th>
                  <th>Order Status</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if ($result4->num_rows > 0) {
                  while ($row = $result4->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='hidden' name='order_id' value='{$row['order_id']}'>{$row['order_id']}</td>";
                    $contact_details = "{$row['full_name']} ,{$row['email']},{$row['phone_number']}";
                    echo "<td>{$contact_details}</td>";
                    echo "<td>{$row['order_date']}</td>";
                    $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";
                    echo "<td>{$address}</td>";
                    echo "<td>{$row['stores']}</td>";
                    $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                    echo "<td>{$products}</td>";
                    echo "<td>{$row['agent']}</td>";
                    echo "<td>";
                    echo "{$row['order_status']}";
                    echo "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<td colspan='8' style='color: red; text-align:center;'> No orders found .</td>";
                }
                ?>
              </tbody>
          </form>
          </table>
          <div class='text-center'>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <button class="open-button btn-warning" onclick="openForm()">Chat with Admin</button>
    <div class="chat-popup" id="myForm">
      <form method="post" class="form-container">
        <h1 class="text-center"> CHAT</h1>

        <label for="msg"> Admin :</label>
        <span for="msg" class='text-primary'>
        
       <?= isset($adminmsg) ? $adminmsg : '' ?>


        </span><span class='text-secondary'> 
        <?= isset($formattedTime) ? $formattedTime : '00:00:00' ?>

        </span><br>

        <label for="msg"> Me :</label>
        <span class="text-success">
         
        <?= isset($message) ? $message : ''?>
          
        </span><span class="text-secondary">
        <?= isset($converttime) ? $converttime : '00:00:00'?>

        </span>
        <textarea name="message" placeholder="type your message....." required></textarea>
        <button type="submit" name='submit' class="btn">Send</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const logoutButton = document.getElementById('logoutButton');

      logoutButton.addEventListener('click', function () {
        logoutUser('LOGOUT');
      });

      function logoutUser(event) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            window.location.href = 'user.php';
          }
        };
        xhr.open('POST', 'user_logout.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('event=' + event);
      }

      var t;
      function resetTimeout() {
        clearTimeout(t);
        t = setTimeout(() => logoutUser('AUTO LOGOUT'), 1800000);
      }

      document.addEventListener('mousemove', resetTimeout);
      document.addEventListener('keydown', resetTimeout);

      function startTimer() {
        t = setTimeout(() => logoutUser('AUTO LOGOUT'), 1800000);
      }

      function resetTimer() {
        clearTimeout(t);
        startTimer();
      }

      startTimer();
      resetTimeout();
    });

    document.getElementById("removeBtn").addEventListener("click", function () {
      if (confirm("Are you sure you want to remove your profile picture?")) {
        const formData = new FormData();
        formData.append('username', '<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>');

        fetch("user_profile_remove.php", {
          method: "POST",
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              document.getElementById("profileImage").src = "uploads/default.jpg";

              window.location.href = "user_panel.php";
            } else {
              alert("Failed to remove profile picture: " + (data.message || ""));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while removing the profile picture.");
          });
      }
    });
  </script>

</html>