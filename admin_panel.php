<?php
session_start();
// error_reporting(0);
include 'dbconnection.php';
$session_name = $_SESSION['admin'];
if ($session_name == "") {
  header("Location: admin.php");
}
$queries = [
  "login_details" => "SELECT COUNT(*) AS count FROM login_details",
  "registration_details" => "SELECT COUNT(*) AS count FROM registration_details",
  "users_complaints" => "SELECT COUNT(*) AS count FROM users_complaints"
];

$results = [];

foreach ($queries as $key => $query) {
  $result = $con->query($query);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $results[$key] = $row['count'];
  } else {
      $results[$key] = 0;
  }
}

$usercount = $results['login_details'];
$regisetr_count = $results['registration_details'];
$complaints_count = $results['users_complaints'];

$folderPaths = [
  'TextFiles/',
];
$totalFileCount = 0;
foreach ($folderPaths as $folderPath) {

  $files = scandir($folderPath);
  $files = array_diff($files, array('.', '..'));
  $fileCount = count($files);
  $totalFileCount += $fileCount;
}
if (isset($_POST['submit'])) {
  $admin_name = $_SESSION['admin'];
  $message = $_POST['admsg'];

  if (isset($_POST['selected_names'])) {
    foreach ($_POST['selected_names'] as $selected_name) {
      $q_insert = "INSERT INTO admin_messages (name, message, agent_name) VALUES ('$admin_name', '$message', '$selected_name')";
      $query_insert = mysqli_query($con, $q_insert);

      if ($query_insert) {
        $q_update = "UPDATE users_messages SET flag=1 WHERE agent_name='$selected_name'";
        $query_update = mysqli_query($con, $q_update);

      }
    }
  }
}


?>

<head>
  <meta charset="utf-8">
  <title>Admin Panel </title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    @-webkit-keyframes marqueeAnimation-4022944 {
      100% {
        margin-left: -609px
      }
    }
  </style>
  <script>
    function realtimeClock() {
      var rtClock = new Date();
      var hours = rtClock.getHours();
      var minutes = rtClock.getMinutes();
      var seconds = rtClock.getSeconds();
      var amPm = (hours < 12) ? "AM" : "PM";
      hours = (hours > 12) ? hours - 12 : hours;
      hours = ("0" + hours).slice(-2);
      minutes = ("0" + minutes).slice(-2);
      seconds = ("0" + seconds).slice(-2);
      document.getElementById('clock').innerHTML = hours + " : " + minutes + " : " + seconds + " " + amPm;
      var t = setTimeout(realtimeClock, 500);
    }


  </script>


</head>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div
        style="width: 1000px; margin-left: 656px; animation: 9.64177s linear 1s infinite normal none running marqueeAnimation-4022944;"
        class="js-marquee-wrapper">
        <div class="js-marquee text-danger " style="margin-right: 0px; float: left; ">
          New feature added: User management module now available. Update user profiles and permissions easily.
        </div>
      </div>
    </div>
  </div>
</div>
<div class="header">
  <h1 class='text-center'>WELCOME ADMIN</h1>
  <div>
    <a class='btn btn-info' title="Refresh-Page" href="admin_panel.php">Refresh</a>
    <a class="btn btn-danger fa fa-sign-out" title="Logout Admin" type="submit" name="done"
      href="admin_logout.php">Logout
    </a>

    <body onload="realtimeClock()" style="text-align:right;">
      <div id="clock"></div>
      <div class="text-center">
        <a href="" title="chat with users " class="btn btn-secondary btn-rounded mb-4" data-toggle="modal"
          data-target="#modalSubscriptionForm">Users Messages</a>
      </div>
    </body>
    <div class="border p-5 mb-5">
      <section>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <div class="card-body ">
                <p class="text-uppercase small mb-2">
                  <i class='fa fa-user'></i>
                  <strong>USERS</strong>
                </p>
                <h5 class="mb-0">
                  <?php echo '<strong><a href="users_details.php">' . $usercount . '</a></strong>'; ?>

                  <small class="text-success ms-2">
                    <i class="fa fa-arrow-up fa-sm pe-1"></i>13,48%</small>
                </h5>
                <hr />
                <p class="text-uppercase text-muted small mb-2">
                  Previous period
                </p>
                <h5 class="text-muted mb-0">11 467</h5>
              </div>
            </div>
            <!-- Card -->
          </div>

          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                <p class="text-uppercase small mb-2">
                  <i class='fa fa-users'></i>

                  <strong>REGISTERATION</strong>
                </p>
                <h5 class="mb-0">


                  <?php echo '<strong><a href="register_details.php">' . $regisetr_count . '</a></strong>'; ?>

                  <small class="text-success ms-2">
                    <i class="fa fa-arrow-up fa-sm pe-1"></i>23,58%</small>
                </h5>

                <hr />

                <p class="text-uppercase text-muted small mb-2">
                  Previous period
                </p>
                <h5 class="text-muted mb-0">38 454</h5>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                <p class="text-uppercase small mb-2">
                  <i class='fa fa-book'></i>
                  <strong>FILES</strong>
                </p>
                <h5 class="mb-0">


                  <?php echo '<strong><a href="list.php">' . $totalFileCount . '</a></strong>'; ?>

                  <small class="text-danger ms-2">
                    <i class="fa fa-arrow-down fa-sm pe-1"></i>23,58%</small>
                </h5>

                <hr />

                <p class="text-uppercase text-muted small mb-2">
                  Previous period
                </p>
                <h5 class="text-muted mb-0">00:05:20</h5>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                <p class="text-uppercase small mb-2">
                  <i class='fa fa-bolt'></i>
                  <strong>USER COMPLAINS </strong>
                </p>
                <h5 class="mb-0">

                  <?php echo '<strong><a href="users_complaints.php">' . $complaints_count . '</a></strong>'; ?>

                  <small class="text-danger ms-2">
                    <i class="fa fa-arrow-down fa-sm pe-1"></i>23,58%</small>
                </h5>

                <hr />

                <p class="text-uppercase text-muted small mb-2">
                  Previous period
                </p>
                <h5 class="text-muted mb-0">24.35%</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
     
      <section>
        <div class="row">
          <div class="col-md-8 mb-4">
            <div class="card">
              <div class="card-body">
              
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                  <li class="nav-item" role="presentation">


                    <a class="nav-link bg-primary text-light btn" title="Registration page" id="ex1-tab-1"
                      data-mdb-toggle="pill" href="index.php" role="tab" target="_SELF" aria-controls="ex1-pills-1"
                      aria-selected="true">Sign up</a>

                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-success text-light" title="login page" id="ex1-tab-1" data-mdb-toggle="pill"
                      href="user.php" role="tab" target="_blank" aria-controls="ex1-pills-1" aria-selected="true">Sign
                      In</a>


                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-dark text-light" title="Go to files " id="ex1-tab-3" data-mdb-toggle="pill"
                      href="files.php" role="tab" target="_SELF" aria-controls="ex1-pills-3" aria-selected="false">Keep
                      Notes
                    </a>
                  </li>

                  <li class="nav-item" role="presentation">

                    <a class="nav-link bg-warning text-dark" title="Calculater" id="ex1-tab-4" data-mdb-toggle="pill"
                      href="calculater.php" role="tab" target="_blank" aria-controls="ex1-pills-4" aria-selected="true"
                      onclick="openCalulater()">Calculater</a>

                  </li>
                </ul>

                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">

                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-primary text-light" title="New Registerations  details" id="ex1-tab-2"
                      data-mdb-toggle="pill" href="register_details.php" target="_blank" role="tab"
                      aria-controls="ex1-pills-2" aria-selected="false">Registerations</a>

                  </li>

                  <li class="nav-item" role="presentation">

                    <a class="nav-link text-light bg-success" title="users login details" id="ex1-tab-1"
                      data-mdb-toggle="pill" href="users_details.php" role="tab" target="_blank"
                      aria-controls="ex1-pills-1" aria-selected="true">login details</a>





                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-dark text-light" title="Contact form" id="ex1-tab-1" data-mdb-toggle="pill"
                      href="contact_form.php" role="tab" target="_blank" aria-controls="ex1-pills-1"
                      aria-selected="true">Contact Form</a>

                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link  bg-warning text-dark btn" title="system status" id="ex1-tab-1"
                      data-mdb-toggle="pill" role="tab" target="_blank" aria-controls="ex1-pills-1" aria-selected="true"
                      onclick="openWindow()">Graphs</a>
                  </li>
                </ul>
               
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">

                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-primary text-light btn" title="Registeration & login with OTP verification "
                      id="ex1-tab-1" data-mdb-toggle="pill" href="/note-keeper/Otpregistration/otp_registration.php"
                      role="tab" target="_blank" aria-controls="ex1-pills-1" aria-selected="true">Registeration & login
                    </a>
                  </li>

                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-success text-light" title="Order Coffee" id="ex1-tab-1" data-mdb-toggle="pill"
                      href="coffee.php" role="tab" target="_self" aria-controls="ex1-pills-1" aria-selected="true">Order
                      Coffee</a>
                  </li>

                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-dark text-light" title="Your saved files" id="ex1-tab-1"
                      data-mdb-toggle="pill" href="list.php" role="tab" target="_blank" aria-controls="ex1-pills-1"
                      aria-selected="true">Saved Files</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link bg-warning text-dark" title="Shopping ,Customer panel" id="ex1-tab-1"
                      data-mdb-toggle="pill" href="/note-keeper/Otpregistration/customer_panel.php" role="tab"
                      target="_blank" aria-controls="ex1-pills-1" aria-selected="true">Shopping</a>
                  </li>



                </ul>
             
                <div class="tab-content" id="ex1-content">
                  <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <div id="chart-users"></div>
                  </div>
                  <div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div id="chart-page-views"></div>
                  </div>
                  <div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <div id="chart-average-time"></div>
                  </div>
                  <div class="tab-pane fade" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">
                    <div id="chart-bounce-rate"></div>
                  </div>
                </div>
             
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body  bg-info text-center ">
                <a class="btn btn text-dark" href="/note-keeper/Otpregistration/orders_details.php" target="_blank"
                  role="button" title='Customer Orders'>Customer Order
                </a>
                <div id="pie-chart-previous"></div>
              </div>
            </div><br>


            <div class="card mb-4">
              <div class="card-body bg-primary text-center ">
                <a class="btn btn text-light" href='users_complaints.php' target="_blank" role="button"
                  title='Complaints Reised by Users'>Users Complaints</a>
                <div id="pie-chart-current"></div>
              </div>
            </div>


            <div class="card mb-4">
              <div class="card-body bg-dark text-center ">
                <a class="btn btn text-light" href='coffee_orders.php' target="_blank" role="button"
                  title='Coffee orders'>Coffee Orders</a>
                <div id="pie-chart-current"></div>
              </div>
            </div>

            <div class="card">
              <div class="card-body bg-success text-center ">
                <a class="btn btn text-light" href='users_login_report.php' target="_blank" role="button"
                  title='Users login reports'>Users Login Reports
                </a>
                <div id="pie-chart-previous"></div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>

  <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">USERS MESSAGES</h4>


        </div>
        <div class="text-left">
          <form method="post">
            &nbsp; <label for="msg"><b>User :</b></label>
            <?php
            $chat = "SELECT * FROM users_messages where flag='0'";
            $result = mysqli_query($con, $chat);

            if (mysqli_num_rows($result) > 0) {
              $sno = 1;
              while ($row = mysqli_fetch_array($result)) {
                $name = $row['agent_name'];
                $timestamp = $row['entry_date'];
                $converttime = date("h:i A", strtotime($timestamp));
                echo '<div>&nbsp;&nbsp;';
                echo '<span>' . $sno . '.</span>&nbsp;&nbsp;';
                echo '<input type="checkbox" name="selected_names[]" value="' . $name . '">&nbsp;&nbsp;<span class="text-primary">' . $name . '</span><br>&nbsp;&nbsp;';
                echo "Message: " . $row['message'] . "<span class='text-secondary'>(" . $converttime . ").</span>";
                echo '</div>';

                $sno++;
              }
            } else {

              echo "Offline";
            }


            ?>
        </div>

        <div class="text-left">
          &nbsp; <label for="msg"><b>Admin :</b></label>
          <?php
          $admin = "select * from admin_messages order by  id desc limit 1";

          $result = mysqli_query($con, $admin);
          if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {

              $adminmsg = $row['message'];
              $time = $row['entry_date'];
              $agent_name = $row['agent_name'];
              $formattedTime = date("h:i A", strtotime($time));
              echo " [ $agent_name ] " . $adminmsg . "<span class='text-secondary' >(" . $formattedTime . ").</span>";

            }
          } else {
            echo "Offline";
          }

          ?>

        </div>

        <div class="modal-footer d-flex justify-content-center">
          <input type="text" name="admsg" class="form-control validate" required>
          <button class="btn btn-info" type="submit" name="submit">Send </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
  
    function resetActivityTimeout() {
      clearTimeout(activityTimeout);
      // 2 minutes in milliseconds 120000
      // Adjust the timeout value (300000ms = 5 minutes)
      // 30 minutes in milliseconds 1800000
      activityTimeout = setTimeout(logoutUser, 1800000);

    }

    function logoutUser() {
      window.location.href = 'admin_logout.php';
      header("Location: admin.php");

    }

    document.addEventListener('mousemove', resetActivityTimeout);
    document.addEventListener('keydown', resetActivityTimeout);
    window.addEventListener('beforeunload', function () {

      logoutUser();
    });


    function startTimer() {

      activityTimeout = setTimeout(logoutUser, 1800000);
    }

    function resetTimer() {
      clearTimeout(activityTimeout);
      startTimer();
    }


    startTimer();
    resetActivityTimeout();

    function openWindow() {
      window.open("././graph.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");
    }
    function openCalulater() {
      window.open("././calculater.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");

    }

    function admin_logout()
    {
     
// session_start();
unset($_SESSION['admin']);
header("location: admin.php");

    }

  </script>