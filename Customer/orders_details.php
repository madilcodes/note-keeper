<?php
// Include database connection file
include '../dbconnection.php';

// Fetch data from the CustomerOrders table
$all_orders = "SELECT * FROM Customer_Orders";
$result = $con->query($all_orders);

$open_orders = "SELECT * FROM Customer_Orders WHERE agent=''";
$result1 = $con->query($open_orders);

$closed_orders = "SELECT * FROM Customer_Orders WHERE agent!='' AND  order_status!='' ";
$result2 = $con->query($closed_orders);

$inprogres_orders = "SELECT * FROM `Customer_Orders` WHERE order_status='' AND agent!='' ";
$result3 = $con->query($inprogres_orders);


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

    $update_status = "UPDATE Customer_Orders SET agent='$assign_agent' WHERE order_id='$order_Id'";
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

$open_count = "SELECT COUNT(*)AS count FROM Customer_Orders WHERE agent=''";
$Ocount = $con->query($open_count);
if ($Ocount->num_rows > 0) {
    $row = $Ocount->fetch_assoc();
    $Opencount = $row['count'];
} else {
    echo "0";
}
$close_count = "SELECT COUNT(*)AS count FROM Customer_Orders WHERE agent!='' AND  order_status!=''";
$Ccount = $con->query($close_count);
if ($Ccount->num_rows > 0) {
    $row = $Ccount->fetch_assoc();
    $closecount = $row['count'];
} else {
    echo "0";
}


$inprogres_count = "SELECT COUNT(*)AS count FROM Customer_Orders  WHERE order_status='' AND agent!=''";
$Ipcount = $con->query($inprogres_count);
if ($Ipcount->num_rows > 0) {
    $row = $Ipcount->fetch_assoc();
    $inprorescount = $row['count'];
} else {
    echo "0";
}

$total_count = "SELECT COUNT(*)AS count FROM Customer_Orders ";
$Tcount = $con->query($total_count);
if ($Tcount->num_rows > 0) {
    $row = $Tcount->fetch_assoc();
    $totalcount = $row['count'];
} else {
    echo "0";
}

// Close the database connection if needed
// $con2->close();
$con->close();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Customer Orders Details</title>
    <link rel="icon" href=".././curdyt/../favicon.jpg" type="image/jpeg">


    <style>
        /* body {font-family: "Lato", sans-serif;} */

        .btn-container {
            text-align: right;
        }

        .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 25%;
        }

        .tablink:hover {
            background-color: #777;
        }

        /* Style the tab content */
        .tabcontent {
            color: white;
            display: none;
            padding: 50px;
            text-align: center;
        }

        #London {
            background-color: salmon;
        }

        #Paris {
            background-color: lightgreen;
        }

        #Tokyo {
            background-color: SandyBrown;
        }

        #Oslo {
            background-color: LightSeaGreen;
        }

        #coffee {
            background-color: Sienna;
        }
    </style>


</head>

<body>


    <div class="bg-info clearfix">
        <h4 class="text-uppercase font-weight-bold text-center text-nowrap">Customer Orders </h4>
        <div class="btn-container">
            <a class="btn btn-warning" href='../Admin/admin_panel.php' title='Back to Dashbord'>Home</a>
            <a class='btn btn-primary' title='Refresh' href='orders_details.php'>Refresh</a>

        </div>
    </div>
    <button class="tablink" onclick="openCity('London', this, 'salmon')" id="defaultOpen">Open Orders - [
        <?= $Opencount; ?> ]
    </button>
    <button class="tablink" onclick="openCity('Paris', this, 'lightgreen')">Close Orders - [
        <?= $closecount; ?> ]
    </button>
    <button class="tablink" onclick="openCity('Tokyo', this, 'SandyBrown')">Inprogress Orders - [

        <?= $inprorescount; ?> ]
    </button>
    <button class="tablink" onclick="openCity('Oslo', this, 'LightSeaGreen')">All Orders - [
        <?= $totalcount; ?> ]
    </button>
    <!-- <a class="tablink" type='button' title='Refresh page' href='orders_details.php'>Refresh  </a> -->


    <div id="London" class="tabcontent">
        <h1 class='text-dark'>Open Orders</h1>

        <table id="dtBasicExample1" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Order ID</th>
                    <th class="th-sm">Customer Name</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Phone Number</th>
                    <th class="th-sm">Entry Date</th>
                    <th class="th-sm">Address</th>
                    <th class="th-sm">Store Name</th>
                    <th class="th-sm">All Items</th>
                    <th class="th-sm">Delivery Agent </th>
                    <th class="th-sm">Action</th>
                </tr>
            </thead>
            <tbody>
                <form method='POST'>
                    <?php
                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            echo "<tr  class='text-justify'>";
                            echo "<td><input type='hidden' name='order_id' value='{$row['order_id']}'>{$row['order_id']}</td>";
                            echo "<td>{$row['full_name']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['phone_number']}</td>";
                            echo "<td>{$row['order_date']}</td>";
                            $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";
                            echo "<td>{$address}</td>";
                            echo "<td>{$row['stores']}</td>";
                            $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                            echo "<td>{$products}</td>";



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
                            echo "</tr>";
                        }
                    } else {
                        echo "<td colspan='10' style='color: white; text-align:center;'> No orders found </td>";

                    }
                    ?>
                </form>
            </tbody>
        </table>
    </div>

    <div id="Paris" class="tabcontent">
        <h1 class='text-dark'>Closed Orders</h1>
        <table id="dtBasicExample1" class="table  table-bordered table-sm text-dark" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th class="th-sm">Order ID</th>
                    <th class="th-sm">Customer Name</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Phone Number</th>
                    <th class="th-sm">Entry Date</th>
                    <th class="th-sm">Address</th>
                    <th class="th-sm">Store Name</th>
                    <th class="th-sm">All Items</th>
                    <th class="th-sm">Delivery Agent </th>
                    <th class="th-sm">Order Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['full_name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['phone_number']}</td>";
                        echo "<td>{$row['order_date']}</td>";

                        $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";

                        echo "<td>{$address}</td>";


                        echo "<td>{$row['stores']}</td>";
                        $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                        echo "<td>{$products}</td>";
                        echo "<td>{$row['agent']}</td>";
                        echo "<td>{$row['order_status']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td colspan='10' style='color: white; text-align:center;'> No Closed orders found </td>";

                }
                ?>
            </tbody>
        </table>
    </div>


    <div id="Oslo" class="tabcontent">
        <h1>All Orders </h1>
        <table id="dtBasicExample1" class="table  table-bordered table-sm text-light" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th class="th-sm">Order ID</th>
                    <th class="th-sm">Customer Name</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Phone Number</th>
                    <th class="th-sm">Entry Date</th>
                    <th class="th-sm">Address</th>
                    <th class="th-sm">Store Name</th>
                    <th class="th-sm">All Items</th>
                    <th class="th-sm">Delivery Agent </th>
                    <th class="th-sm">Order Status</th>
                    <!-- <th class="th-sm">Action </th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['full_name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['phone_number']}</td>";
                        echo "<td>{$row['order_date']}</td>";
                        $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";
                        echo "<td>{$address}</td>";
                        echo "<td>{$row['stores']}</td>";
                        $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                        echo "<td>{$products}</td>";
                        echo "<td>{$row['agent']}</td>";
                        echo "<td>{$row['order_status']}</td>";
                        // echo "<td> <a class=' btn btn-dark'>Assign</a> </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td colspan='11' style='color: white; text-align:center;'> No orders found </td>";

                }
                ?>
            </tbody>
        </table>
    </div>


    <div id="Tokyo" class="tabcontent">
        <h1>Inprogress Orders</h1>
        <table id="dtBasicExample1" class="table  table-bordered table-sm text-light" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th class="th-sm">Order ID</th>
                    <th class="th-sm">Customer Name</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Phone Number</th>
                    <th class="th-sm">Entry Date</th>
                    <th class="th-sm">Address</th>
                    <th class="th-sm">Store Name</th>
                    <th class="th-sm">All Items</th>
                    <th class="th-sm">Delivery Agent </th>
                    <th class="th-sm">Order Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result3->num_rows > 0) {
                    while ($row = $result3->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['full_name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['phone_number']}</td>";
                        echo "<td>{$row['order_date']}</td>";
                        $address = "{$row['house_number']}, {$row['area']}, {$row['pincode']}, {$row['landmark']}, {$row['city']}, {$row['state']}";
                        echo "<td>{$address}</td>";
                        echo "<td>{$row['stores']}</td>";
                        $products = "{$row['pulses']}, {$row['oils']}, {$row['kitchens']}, {$row['snacks']}, {$row['drinks']}, {$row['breakfast_cereals']}, {$row['dairy']}, {$row['household_care']}";
                        echo "<td>{$products}</td>";
                        echo "<td>{$row['agent']}</td>";
                        echo "<td>{$row['order_status']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td colspan='10' style='color: white; text-align:center;'> No Inprogress orders found </td>";

                }
                ?>
            </tbody>
        </table>
    </div>

    </div>


    <script>
        function openCity(cityName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(cityName).style.display = "block";
            elmnt.style.backgroundColor = color;

        }
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        $(document).ready(function () {
            $('#dtBasicExample1').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

</body>

</html>