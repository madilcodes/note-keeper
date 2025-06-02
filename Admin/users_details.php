<?php
session_start();
include '../dbconnection.php';
$session = $_SESSION['admin'];
if ($session == "") {
    header("Location: admin.php");
}
$id = "SELECT  COUNT(*)AS count FROM login_details";
$result = $con->query($id);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Details</title>
    <link rel="icon" href="../favicon.jpg" type="image/jpeg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function myFunction() {
            window.open("userchart.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
        }

        function confirmDelete(userId) {
            if (confirm("Are you sure to logout this user?")) {
                window.location.href = 'user_force_logout.php?sno=' + userId;
            }
        }
    </script>

</head>

<body>
    <div class="container">
        <div class="col-lg-10">
            <h1 class="text-success text-center">Login Details </h1>
            <br>
            <div>
                <div class="row">
                
                    <div class="col-sm">
                     
                        <div class="small-box bg-warning">
                            <div class="inner text-center">
                                <h3>
                                    <?= isset($count) ? $count : 0; ?>
                                </h3>

                                <p>TOTAL NO.OF LOGINS</p>
                            </div>

                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
                            <a class='btn btn-info text-light' title="Show-Charts" onclick="myFunction()"> ➜
                                Visualization
                                Chart</a>
                            <a class='btn btn-primary fa fa-spinner' title="Refresh-Page"
                                href="users_details.php">Refresh</a>
                            <a class='btn btn-success fa fa-download' title="Download Login-Details"
                                onclick="window.print()"></a>

                            <hr>

                        </div>
                        <table class=" table table-striped table-hover table-bordered text-center">
                            <tr class="bg-dark text-white ">
                                <th>Sno</th>
                                <th> Username </th>
                                <th> Password </th>
                                <th></th>
                                <th> Login Time </th>
                                <th> Logout Time </th>
                                <th> Status</th>
                                <th> Action </th>
                            </tr>

                            <?php

                            $q = "SELECT * FROM login_details ORDER BY login_time DESC";
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
                                  
                                    <td  class='password-cell'  oncopy='return false' onpaste='return false' align='center'  nowrap><input type=text  style='text-align:center;' name='password' class='password-input' value ='********' readonly/></td>
                                    <td><input type='checkbox' title='Show password' class='password-toggle' data-id="<?php echo $res['sno']; ?>"></td>
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
                                        <a class="btn-danger btn fa fa-trash text-light"
                                            onclick="confirmDelete(<?php echo $res['sno']; ?>);" title="Delete User"></a>
                                    </td>
                                </tr>
                                <?php
                                $sno++;
                            }
                            ?>
                        </table>
</body>

</html>
<script>
   
   document.addEventListener("DOMContentLoaded", function () {
    const toggleCheckboxes = document.querySelectorAll('.password-toggle');

    toggleCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const passwordInput = this.parentElement.parentElement.querySelector('.password-input');

            if (this.checked) {
                const sno = this.getAttribute('data-id');
                fetchPasswordFromServer(sno, passwordInput);
            } else {
                passwordInput.value = '********';
            }
        });
    });


        function fetchPasswordFromServer(sno, passwordInput) {
        fetch('get_passwords.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'sno=' + sno,
        })
            .then(response => response.text())
            .then(data => {
                passwordInput.value = data;
            })
            .catch(error => {
                console.error('Error fetching password:', error);
            });
    }
});

   
    const interval = 5 * 60 * 1000;
    function runQuery() {

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "execute_query.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send();
    }
    runQuery();
    setInterval(runQuery, interval);
    function refreshPage() {
        location.reload();
    }
    setInterval(refreshPage, interval);
</script>