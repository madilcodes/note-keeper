<?php
session_start();
include '../dbconnection.php';
$loggedInEmail = $_SESSION['email'];
if (isset($_POST['done'])) {

  // Your form data
  $full_name = $_POST['full_name'];
  $phone_number = $_POST['phone_number'];
  $house_number = $_POST['house_number'];
  $area = $_POST['area'];
  $pincode = $_POST['pincode'];
  $landmark = $_POST['landmark'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $stores = $_POST['stores'];
  $pulses = $_POST['pulses'];
  $oils = $_POST['oils'];
  $kitchens = $_POST['kitchens'];
  $snacks = $_POST['snacks'];
  $drinks = $_POST['drinks'];
  $breakfast_cereals = $_POST['breakfast_cereals'];
  $dairy = $_POST['dairy'];
  $household_care = $_POST['household_care'];

  if (isset($_SESSION['email'])) {
    // SQL Insert Query
    $sql = "INSERT INTO Customer_Orders 
          (full_name, email, phone_number, house_number, area, pincode, landmark, city, state,
           stores, pulses, oils, kitchens, snacks, drinks, breakfast_cereals, dairy, household_care)
          VALUES 
          ('$full_name', '$loggedInEmail', '$phone_number', '$house_number', '$area', '$pincode', '$landmark', '$city', '$state',
           '$stores', '$pulses', '$oils', '$kitchens', '$snacks', '$drinks', '$breakfast_cereals', '$dairy', '$household_care')";

// echo $sql;exit;
    // Execute the SQL query
    $result = $con->query($sql);

    if ($result) {
      // Order placed successfully
      echo "<div class='alert alert-success' role='alert'>
              Order placed successfully.
              <button type='button' class='btn-close' class='float-right'  data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } else {
      // Error in SQL query
      echo "<div class='alert alert-danger' role='alert'>
              Error placing order. Please try again.
              <button type='button' class='btn-close' class='float-right'  data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
  } else {
    // Session not present, show error message
    echo "<div class='alert alert-danger' role='alert'>
          Please login to place the order.
          <button type='button' class='btn-close'  class='float-right' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
}

if (isset($_SESSION['email'])) {
  $orders = "SELECT * FROM Customer_Orders WHERE email='$loggedInEmail'";
  $result = $con->query($orders);
  $coffee_orders = "SELECT * FROM coffee_orders WHERE email='$loggedInEmail'";
  $result2 = $con->query($coffee_orders);

}

// if (isset($_SESSION['IS_LOGIN'])) {
// }
// Close the database connection
$con->close();
// $con2->close();



?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Customer panel</title>
  <link rel="icon" href=".././curdyt/favicon.jpg" type="image/jpeg">

  <link rel="stylesheet" href="customer_panel_style.css">
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




  <script>
    $(document).ready(function () {
      $('#form2Example3c').change(function () {
        if ($(this).prop('checked')) {
          $('#placeOrderBtn').prop('disabled', false);
        } else {
          $('#placeOrderBtn').prop('disabled', true);
        }
      });
    });



    function confirmDelete(userId) {
      if (confirm("Are you sure to Cancel this Order?")) {
        // If the user confirms, redirect to the delete_user.php script with the user's ID
        window.location.href = '../curdyt/delete_order.php?order_id=' + userId;
      } else {
        // If the user cancels, do nothing
      }
    }

    function ConfirmDelete(orderId) {
      if (confirm("Are you sure to Cancel this Order?")) {
        // If the user confirms, redirect to the delete_user.php script with the user's ID
        window.location.href = '../curdyt/cancel_order.php?order_id=' + orderId;
      } else {
        // If the user cancels, do nothing
      }
    }

  </script>
  <style type="text/css">
    .navbar-nav li:hover>ul.dropdown-menu {
      display: block;
    }

    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
      text-decoration: underline;
      transform: rotate(-90deg);
    }
  </style>
</head>

<body class='body'>


  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center " href="#" id="navbarDropdownMenuAvatar" role="button"
            data-toggle="dropdown" aria-expanded="false">
            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25"
              alt="Black and White Portrait of a Man" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown">
            <li>
              <a class="dropdown-item" title=" <?php
              if (isset($_SESSION['email'])) {
                echo $loggedInEmail;

              }
              ?>" href="#">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="../curdyt/contact_form.php">Contact Us</a>
            </li>
            <li>
              <a class="dropdown-item" href="logout.php" title='Logout'>Logout</a>
            </li>
          </ul>
        </div>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Dashboard</a>
          </li>

          <li class="nav-item">
            <a class="btn btn-success text-light" href="../curdyt/coffee.php">Order Coffee</a>
          </li>
          <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
            aria-describedby="search-addon" />

          <!-- Left links -->
      </div>

      <!-- Collapsible wrapper -->
      <div class="d-flex align-items-center">
        <a type="button" class="btn btn-light px-3 me-2" href='.././Otpregistration/customer_login.php'>
          Login
        </a>&nbsp;&nbsp;
        <a type="button" class="btn btn-light me-3" href='.././Otpregistration/customer_registration.php'>
          Sign up for free
        </a>

      </div>
      </ul>&nbsp;&nbsp;&nbsp;&nbsp;

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <a href="" title="My Orders " class="btn btn-primary" data-toggle="modal"
          data-target=".bd-example-modal-lg">Cart
          <i class="fa fa-shopping-cart"></i>
        </a>&nbsp;&nbsp;

        <a href="" title="View Orders " class="btn btn-warning" data-toggle="modal"
          data-target=".bd-example-modal-lg2">Coffee
          <i class="fa fa-coffee"></i>
        </a>&nbsp;&nbsp;<a href='customer_panel.php' class='text-light'><i class="fa fa-spinner "></i></a>

      </div>
      <!-- Avatar -->

    </div>
    <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <form method="post">
    <section class="h-50 h-custom gradient-custom-2">
      <div class="container py-5 h-50">
        <div class="row d-flex justify-content-center align-items-center h-50">
          <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
              <div class="card-body p-0">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="p-5">
                      <h3 class="fw-normal mb-5" style="color: #4835d4;">Shopping</h3>
                      <div class="mb-4 pb-2">
                        <label class="form-label" for="form3Example1n1">Store's & shopping mall's</label>
                        <select name="stores" class="select form-control">
                          <option class="dropdown-item">D Mart </option>
                          <option class="dropdown-item">Big Bazar </option>
                          <option class="dropdown-item">Balaji Grand Bazar</option>
                          <option class="dropdown-item">Ratnadeep Supermarket </option>
                          <option class="dropdown-item">Heritage Fresh</option>
                          <option class="dropdown-item">SPAR Hypermarket</option>
                          <option class="dropdown-item">Vijetha Super Market</option>
                        </select>
                      </div>
                      <div class="mb-4 pb-2">
                        <label class="form-label" for="form3Example1n1">Search Grocery Products</label>
                        <nav class="navbar navbar-expand-md navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  Staples
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Dals &
                                      Pulses</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="pulses" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>
                                          <option class="dropdown-item">Toovar dal </option>
                                          <option class="dropdown-item">Chana dal </option>
                                          <option class="dropdown-item">Moong dal</option>
                                          <option class="dropdown-item">Urad dal </option>
                                          <option class="dropdown-item">Soya Chunks</option>
                                          <option class="dropdown-item">Rajma</option>
                                        </select>
                                      </li>
                                    </ul>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Ghee & Oils</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="oils" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>
                                          <option class="dropdown-item">Blended Oil</option>
                                          <option class="dropdown-item">Ghee</option>
                                          <option class="dropdown-item">Sunflower Oil</option>
                                          <option class="dropdown-item">Olive Oil</option>
                                          <option class="dropdown-item">Grounut Oil</option>
                                          <option class="dropdown-item">Mustard Oil</option>
                                        </select>
                                      </li>
                                    </ul>
                                </ul>
                              </li>
                            </ul>
                            </li>
                            </ul>
                          </div>
                        </nav>
                        <nav class="navbar navbar-expand-md navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  Home & Kitchens
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Storage &
                                      Cointainers</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="kitchens" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Cookware & Non-Stick </option>
                                          <option class="dropdown-item">Dining & Cutley </option>
                                          <option class="dropdown-item">Household Esseionals </option>
                                        </select>
                                      </li>
                                    </ul>
                                </ul>
                              </li>
                            </ul>
                            </li>
                            </ul>
                          </div>
                        </nav>
                        <nav class="navbar navbar-expand-md navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  Snacks & Beverages
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Packaged
                                      Food</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="snacks" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Tea</option>
                                          <option class="dropdown-item">Cookies</option>
                                          <option class="dropdown-item">Coffee</option>
                                          <option class="dropdown-item">Cream Biscuits
                                          </option>
                                          <option class="dropdown-item">Wafers & Rusk</option>
                                        </select>
                                      </li>
                                    </ul>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Cool drinks &
                                      Juices </a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="drinks" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Marie Digestive</option>
                                          <option class="dropdown-item">Glucose </option>
                                          <option class="dropdown-item">Health Drink Mix</option>
                                          <option class="dropdown-item">Salted</option>
                                          <option class="dropdown-item">Soft Drinks</option>
                                          <option class="dropdown-item">Instant Drink Mixes</option>
                                        </select>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </div>
                        </nav>
                        <nav class="navbar navbar-expand-md navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  Dairy & Eggs
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Breakfast
                                      Cereals
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="breakfast_cereals" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Noodles</option>
                                          <option class="dropdown-item">Pasta</option>
                                          <option class="dropdown-item">Muesli</option>
                                          <option class="dropdown-item">Oats</option>
                                          <option class="dropdown-item">Chocolates</option>
                                          <option class="dropdown-item">Flakes</option>
                                          <option class="dropdown-item">Jams</option>
                                          <option class="dropdown-item">Honey</option>
                                          <option class="dropdown-item">Pickles</option>
                                        </select>
                                      </li>
                                    </ul>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Dairy &
                                      Kitche</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="dairy" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Eggs </option>
                                          <option class="dropdown-item">Milk</option>
                                          <option class="dropdown-item">Flavoured Milk</option>
                                          <option class="dropdown-item">Cheese</option>
                                          <option class="dropdown-item">Curd & Yogurts</option>
                                          <option class="dropdown-item">Butter & Spreads</option>
                                          <option class="dropdown-item">Paneer & Tofu</option>
                                          <option class="dropdown-item">Soya and Almond Milk</option>
                                          <option class="dropdown-item">Buttermilk</option>
                                          <option class="dropdown-item">Lassi</option>
                                        </select>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </div>
                        </nav>
                        <nav class="navbar navbar-expand-md navbar-light bg-light">
                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  Household Care
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle">Detergents &
                                      Laundry</a>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <select name="household_care" class="select form-control">
                                          <option value="" class="dropdown-item">Select item</option>

                                          <option class="dropdown-item">Tide</option>
                                          <option class="dropdown-item">Washing Bars</option>
                                          <option class="dropdown-item">Persil</option>
                                          <option class="dropdown-item">Ariel</option>
                                          <option class="dropdown-item">Woolite </option>
                                          <option class="dropdown-item">Purex</option>
                                          <option class="dropdown-item">Aluminium Foils </option>
                                          <option class="dropdown-item">Paper Napkins </option>
                                          <option class="dropdown-item">Disposable Plates</option>
                                          <option class="dropdown-item">Kitchen Roll</option>
                                          <option class="dropdown-item">Toilet Paper </option>
                                          <option class="dropdown-item">Garbage Bags</option>
                                        </select>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                          </div>
                        </nav>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 bg-indigo text-white">
                    <div class="p-5">
                      <h3 class="fw-normal mb-5">Delivery Address</h3>
                      <div class="mb-4 pb-2">
                        <div class="form-outline form-white">
                          <label class="form-label" for="form3Examplea9">Full Name</label>
                          <input type="text" name="full_name" id="form3Examplea2" class="form-control form-control-lg"
                            required />
                        </div>
                      </div>
                      <div class="mb-4 pb-2">

                      </div>
                      <div class="mb-4 pb-2">
                        <div class="form-outline form-white">
                          <label class="form-label" for="form3Examplea8">Phone Number</label>
                          <input type="number" name="phone_number" id="form3Examplea3"
                            class="form-control form-control-lg" value='<?= $loggedInEmail; ?>' required />
                        </div>
                      </div>
                      <div class="mb-4">
                        <div class="form-outline form-white">
                          <label class="form-label" for="form3Examplea2">Flat,House no.,Building,Company,Apartment
                          </label>
                          <input type="text" id="form3Examplea9" name="house_number"
                            class="form-control form-control-lg" required />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5 mb-4 pb-2">
                          <div class="form-outline form-white">
                            <label class="form-label" for="form3Examplea2">Area,Street</label>
                            <input type="text" name="area" id="form3Examplea4" class="form-control form-control-lg"
                              required />
                          </div>
                        </div>
                        <div class="col-md-7 mb-4 pb-2">
                          <div class="form-outline form-white">
                            <label class="form-label" for="form3Examplea4">Pincode</label>
                            <input type="number" name="pincode" id="form3Examplea5" class="form-control form-control-lg"
                              required />
                          </div>
                        </div>
                      </div>
                      <div class="mb-4 pb-2">
                        <div class="form-outline form-white">
                          <label class="form-label" for="form3Examplea5">Landmark</label>
                          <input type="text" name="landmark" id="form3Examplea6" class="form-control form-control-lg"
                            required />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5 mb-4 pb-2">
                          <div class="form-outline form-white">
                            <label class="form-label" for="form3Examplea6">Town/City</label>
                            <input type="text" name="city" id="form3Examplea7" class="form-control form-control-lg"
                              required />
                          </div>
                        </div>
                        <div class="col-md-7 mb-4 pb-2">
                          <div class="form-outline form-white">
                            <label class="form-label" for="form3Examplea6">State</label>
                            <input type="text" name="state" id="form3Examplea8" class="form-control form-control-lg"
                              required />
                          </div>
                        </div>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" required />
                        <label class="form-check-label text-white" for="form2Example3">&nbsp;&nbsp;&nbsp;&nbsp;
                          I do accept the <a href="#!" class="text-white"><u>Terms and Conditions</u></a> of your site.
                        </label>
                      </div>
                      <button type="submit" name="done" id="placeOrderBtn" class="btn btn-light btn-lg" disabled>
                        Place Order
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <!-- <model for orders -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">MY ORDERS</h4>
              </div>

              <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

                <thead>
                  <tr>
                    <th class="th-sm">Order ID</th>
                    <th class="th-sm">Order Date</th>
                    <th class="th-sm">Store Name</th>
                    <th class="th-sm">All Items</th>
                    <th class="th-sm">Order Status</th>
                    <th class="th-sm">Action</th>


                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$row['order_id']}</td>";
                      echo "<td>{$row['order_date']}</td>";
                      echo "<td>{$row['stores']}</td>";
                      $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                      echo "<td>{$products}</td>";
                      echo "<td>{$row['order_status']}</td>";
                      echo "<td>
    <a class='btn-danger btn fa fa-trash text-light'
        onclick='ConfirmDelete({$row['order_id']});' title='Cancel Order'></a>
  </td>";
                      echo "</tr>";
                    }

                    // No orders found for the logged-in user
                    // echo"<td colspan='5' style='color: red; text-align:center;'> No orders found for the logged-in user.</td>";
                  
                  } else {
                    // Session not present, show error message
                    echo "<td colspan='6' style='color: red; text-align:center;'> Please login to check your orders.</td>";
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- <model for coffee orders -->
        <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">COFFEE ORDERS</h4>
              </div>
              <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Contact Details</th>
                    <th>Order Details</th>
                    <th>Amount</th>
                    <th>Order On</th>
                    <th>Action </th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    if ($result2->num_rows > 0) {
                      while ($row = $result2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        $address = "{$row['customer_name']}, {$row['email']}";
                        echo "<td>{$address}</td>";
                        $order_details = "{$row['coffee_type']}, {$row['size']},{$row['sugar']}-Quantity:[{$row['quantity']}]";
                        echo "<td>{$order_details}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['order_time']}</td>";
                        echo "<td>
    <a class='btn-danger btn fa fa-trash text-light'
        onclick='confirmDelete({$row['order_id']});' title='Cancel Order'></a>
  </td>";
                        echo "</tr>";
                      }
                      // echo"<td colspan='4' style='color: red; text-align:center;'> No orders found for the logged-in user.</td>";
                    
                    } else {
                      // Session not present, show error message
                      echo "<td colspan='6' style='color: red; text-align:center;'> Please login to check your orders.</td>";
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</body>

</html>