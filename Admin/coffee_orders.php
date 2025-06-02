<?php
include '../dbconnection.php';
session_start();
$session_name = $_SESSION['admin'];
if ($session_name == "") {
    header("Location: admin.php");
}
$query = "SELECT * FROM coffee_orders WHERE order_status='' AND agent=''";
$result = $con->query($query);

$availabe_agents = "SELECT  username FROM  login_details WHERE event='Online'";
$Result = $con->query($availabe_agents);
$agents = [];
if ($Result->num_rows > 0) {
    while ($agentRow = $Result->fetch_assoc()) {
        $agents[] = $agentRow;
    }
}

if (isset($_POST['submit'])) {
    $order_Id = $_POST['order_id'];
    $assign_agent = $_POST['username'];

    $update_status = "UPDATE coffee_orders SET agent='$assign_agent' WHERE order_id='$order_Id'";
    $result3 = mysqli_query($con, $update_status);

    if ($result3) {
        echo '<div class="alert alert-primary" role="alert">
             Order no: ' . $order_Id . ' has been assigned to the ' . $assign_agent . '.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
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
    <link rel="icon" href="../../favicon.jpg" type="image/jpeg">


    <script>

        function confirmDelete(userId) {
            if (confirm("Are you sure to delete this order?")) {
                window.location.href = 'delete_coffee.php?order_id=' + userId;
            }
        }
    </script>
</head>

<body>

    <div class="container mt-5">
        <h2 style='text-align:center;'> Coffee Orders </h2>

        <input type="text" id="search" class="form-control" placeholder="Search...">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
            <a class='btn btn-primary fa fa-spinner' title="Refresh-Page" href="coffee_orders.php">Refresh</a>
            <hr>

        </div>
        <table class="table table-bordered mt-3" id="data-table">
            <thead>
                <tr class="header">
                    <th>Order ID</th>
                    <th>Customer Details</th>
                    <th>Order Details</th>
                    <th>Order placed time</th>
                    <th>Order Delevered time</th>
                    <th>Delivery Agent</th>
                    <th></th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <form method='POST'>
                    <?php

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='hidden' name='order_id' value='{$row['order_id']}'>{$row['order_id']}</td>";
                            $address = "{$row['customer_name']}, {$row['email']}";
                            echo "<td>{$address}</td>";
                            $order_details = "{$row['coffee_type']}, {$row['size']},{$row['sugar']}";
                            echo "<td>{$order_details}</td>";
                            echo "<td>{$row['order_time']}</td>";
                            echo "<td>{$row['order_delivered_time']}</td>";
                            echo '<td><select name="username" required>';
                            if (!empty($agents)) {
                                foreach ($agents as $agent) {
                                    echo '<option value="' . $agent['username'] . '">' . $agent['username'] . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled selected>No Agents</option>';
                            }
                            echo '</select></td>';
                            echo "<td><button type='submit' class='btn btn-success' name='submit'>Assign</button></td>";

                            echo "<td><a class='btn-danger btn fa fa-trash text-light' title='Delete Order' onclick='confirmDelete(" . $row['order_id'] . ");'></a></td>";
                            echo "</tr>";

                        }
                    } else {
                        echo "<tr><td class='text-center text-danger' colspan='5'> No Orders</td></tr>";
                    }
                    ?>
                </form>
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