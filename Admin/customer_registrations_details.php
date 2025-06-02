<?php
include '../dbconnection.php';
session_start();
$session_name = $_SESSION['admin'];
if ($session_name == "") {
  header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Customer Registrations</title>
  <link rel="icon" href="../favicon.jpg" type="image/jpeg">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</head>

<body>
  <div class='text-center'>

    <h4><b> Customer Registrations</b></h4>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class='btn btn-primary' title="Refresh-Page" href="customer_registrations_details.php">Refresh</a>
      <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
    </div>
  </div>
  <div class="container">

    <table class="table table-bordered">
      <thead>
        <tr class='bg-success'>
          <th>sno</th>
          <th>User name</th>
          <th>password </th>
          <th>Suscribe </th>
          <th>complaint raised On</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $q = "SELECT * FROM customer_registrations ORDER BY custo_id ASC";
        $query = mysqli_query($con, $q);
        $sno=1;
        while ($res = mysqli_fetch_array($query)) {
          ?>
          <tr>
            <td>
              <?php echo $sno; ?>
            </td>
            <td>
              <?php
               $address = "{$res['first_name']}, {$res['last_name ']}";
                            echo "<td>{$address}</td>";
              ?>
            </td>
            <td>
              <?php echo $res['email']; ?>
            </td>
            <td>
              <?php echo $res['password ']; ?>
            </td>
             <td>
              <?php echo $res['subscribe']; ?>
            </td>
             <td>
              <?php echo $res['registration_date ']; ?>
            </td>
          </tr>
          <?php
          $sno++;
        }
        ?>
      </tbody>
    </table>


  </div>
</body>

</html>