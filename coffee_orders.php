<?php
include 'dbconnection.php';
session_start();
$session_name = $_SESSION['admin'];
if ($session_name == "") {
  header("Location: admin.php");
}
$query = "SELECT * FROM coffee_orders";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <title>Coffee Orders</title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">


  <script>

    function confirmDelete(userId) {
            if (confirm("Are you sure to delete this user?")) {
                window.location.href = 'delete_coffee.php?order_id=' + userId;
            } 
        }
  </script>
</head>

<body>

<div class="container mt-5">
  <h2 style='text-align:center;'> Coffee Orders </h2>

<input type="text" id="search" class="form-control" placeholder="Search...">

<table class="table table-bordered mt-3" id="data-table">
    <thead>
        <tr class="header">
            <th>Order ID</th>
            <th>Customer Details</th>
            <th>Order Details</th>
            <th>Order placed time</th>
            <th>Order Delevered time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // $sno = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['order_id']}</td>";
                $address = "{$row['customer_name']}, {$row['email']}";
                echo "<td>{$address}</td>";
                $order_details = "{$row['coffee_type']}, {$row['size']},{$row['sugar']}";
                echo "<td>{$order_details}</td>";
                echo "<td>{$row['order_time']}</td>";
                echo "<td>{$row['order_delivered_time']}</td>";
                echo "<td><a class='btn-danger btn fa fa-trash text-light' title='Delete Order' onclick='confirmDelete(" . $row['order_id'] . ");'></a></td>";
                echo "</tr>";
                // $sno++;
            }
        } else {
            echo "<tr><td class='text-center text-danger' colspan='5'> No Orders</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#data-table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

</body>

</html>