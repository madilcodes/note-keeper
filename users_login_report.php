<?php
session_start();
include 'dbconnection.php';
$session = $_SESSION['admin'];
if ($session == "") {
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Details</title>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="col-lg-10">
        <h1 class="text-success text-center">Users login Report </h1>
    </div>

    <div class="container">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>

            <a class='btn btn-primary fa fa-spinner' title="Refresh-Page" href="users_login_report.php">Refresh</a>
            <a class='btn btn-success fa fa-download' title="Download Login-Details" onclick="window.print()"></a>

            <hr>

        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th> Username </th>
                    <th> Login Time </th>
                    <th> Logout Time </th>
                    <th> Event </th>
                    <th> Login duartion</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $q = "SELECT  username,event,login_time,logout_time,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, login_time, logout_time)) AS diff_time FROM login_details_log ORDER BY login_time DESC;";

                $query = mysqli_query($con, $q);
                $sno = 1;
                while ($res = mysqli_fetch_array($query)) {
                    ?>
                    <tr>

                        <td>
                            <?php echo $sno; ?>
                        </td>
                        <td>
                            <?php echo $res['username']; ?>
                        </td>
                        <td>
                            <?php echo $res['login_time']; ?>
                        </td>
                        <td>
                            <?php echo $res['logout_time']; ?>
                        </td>
                        <td>
                            <?php echo $res['event']; ?>
                        </td>
                        <td>
                            <?php echo $res['diff_time']; ?>
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