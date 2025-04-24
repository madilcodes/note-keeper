<?php
include 'con.php';
session_start();
$session_name = $_SESSION['admin'];
if ($session_name == "") {
  header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>User's Complaints</title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</head>

<body>
  <div class='text-center'>

    <h4><b> User's Complaints</b></h4>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class='btn btn-primary' title="Refresh-Page" href="users_complaints.php">Refresh</a>
      <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
    </div>
  </div>
  <div class="container">

    <table class="table table-bordered">
      <thead>
        <tr class='bg-success'>
          <th>complaint Id</th>
          <th>User name</th>
          <th>Complaints </th>
          <th>complaint raised On</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $q = "SELECT * FROM users_complaints ORDER BY sno ASC";
        $query = mysqli_query($con, $q);
        $sno=1;
        while ($res = mysqli_fetch_array($query)) {
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


  </div>
</body>

</html>