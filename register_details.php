<?php
session_start();
include 'con.php';
$session = $_SESSION['admin'];
if ($session == "") {
  header("Location: admin.php");
}

$query = "
    SELECT 'Total' AS state, COUNT(*) AS count FROM registration_details
    UNION ALL
    SELECT state, COUNT(*) AS count FROM registration_details GROUP BY state
";
$result = $con->query($query);

$stateCounts = array();
$totalCount = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['state'] == 'Total') {
            $totalCount = $row['count'];
        } else {
            $stateCounts[$row['state']] = $row['count'];
        }
    }
}

?>

<head>
  <title>Registration Details</title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
    function myFunction() {
      window.open("././registeration_chart.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=450,height=400");
    }


  </script>
</head>

<body>
  <div>
    <h1 class="text-info text-center">Registration Details </h1>
    <br>
    <div class="row">
      <div class="col-sm">
       
        <div class="small-box bg-primary">
          <div class="inner text-center">
            <h3>
              <?= isset($totalCount) ? $totalCount : 0; ?>
            </h3>

            <p>Total Registrations</p>
          </div>

        </div>
      </div>
    
      <div class="col-sm">
       
        <div class="small-box bg-info">
          <div class="inner text-center">
          <h3>
    <?= isset($stateCounts['Telangana']) ? $stateCounts['Telangana'] : 0; ?>
</h3>


            <p>TELANGANA</p>
          </div>

        </div>
      </div>
    
      <div class="col-sm">
      
        <div class="small-box bg-warning">
          <div class="inner text-center">
            <h3>
              <?= isset($stateCounts['Assam'] ) ? $stateCounts['Assam']  : 0; ?>
            </h3>

            <p>ASSAM</p>
          </div>

        </div>
      </div>
      <div class="col-sm">
    
        <div class="small-box bg-secondary">
          <div class="inner text-center">
            <h3>
              <?= isset($stateCounts['Delhi']) ? $stateCounts['Delhi'] : 0; ?>
            </h3>

            <p>DELHI</p>
          </div>

        </div>
      </div>
    
      <div class="col-sm">
       
        <div class="small-box bg-success">
          <div class="inner text-center">
            <h3>
              <?= isset($stateCounts['Goa']) ? $stateCounts['Goa'] : 0; ?>
            </h3>

            <p>GOA</p>
          </div>

        </div>
      </div>
    
      <div class="col-sm">
       
        <div class="small-box bg-danger">
          <div class="inner text-center">
            <h3>
              <?= isset( $stateCounts['Gujrat']) ?  $stateCounts['Gujrat'] : 0; ?>
            </h3>

            <p>GUJRAT</p>
          </div>

        </div>
      </div>
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
      <a class='btn btn-info' title="Show-Charts" onclick="myFunction()"> ➜ Visualization Chart</a>
      <a class='btn btn-primary fa fa-spinner' title="Refresh-Page" href="register_details.php">Refresh</a>
      <a class='btn btn-success fa fa-download' title="Download Registration-Details" onclick="window.print()"></a>

    </div>
    <hr>
    <div class="col-lg-12">
      <table class=" table table-striped table-hover table-bordered">
        <tr class="bg-dark text-white text-center">
       
        <th> sno </th>
          <th> Name </th>
          <th> email </th>
          <th> password </th>
          <th></th>
          <th> phonenumber </th>
          <th> Gender </th>
          <th> state </th>
          <th> city </th>
          <th> Services </th>
       
          <th> Date of registration</th>
          <th> Action </th>
       
        </tr>

        <?php
       
        $query = "SELECT registration_id,Name,email,phonenumber,gender,state,city,Services,entry_date FROM registration_details ";
        $result = $con->query($query);
        $sno=1;       

        while ($res = $result->fetch_assoc()) {
         
          ?>
          <tr>
            <td><?= $sno;?></td>
            
            <td>
              <?php echo $res['Name']; ?>
            </td>
            <td>
              <?php echo $res['email']; ?>
            </td>



       

            <td align=center class='password-cell'  oncopy='return false' onpaste='return false' align='center'  nowrap><input type=text  style='text-align:center;' name='password' class='password-input' value ='********' readonly/></td>
            <td><input type='checkbox' title='Show password' class='password-toggle' data-id="<?php echo $res['registration_id'];?>"></td>

            <td>
              <?php echo $res['phonenumber']; ?>
            </td>
            <td>
              <?php echo $res['gender']; ?>
            </td>
            <td>
              <?php echo $res['state']; ?>
            </td>
            <td>
              <?php echo $res['city']; ?>
            </td>
            <td>
              <?php echo $res['Services']; ?>
            </td>
           
            <td>
              <?php echo $res['entry_date']; ?>
            </td>

            <td> <a title="Delete-User" class="btn btn-danger fa fa-trash"
                href="delete_registration.php?registration_id=<?php echo $res['registration_id']; ?>"
                onclick="return confirm('Are you sure you want to delete this user?');" class="text-white">
              </a></td>

          

          </tr>
          <?php
          $sno++;
        }
        ?>

      </table>

      <script>


        document.addEventListener("DOMContentLoaded", function () {
    const toggleCheckboxes = document.querySelectorAll('.password-toggle');

    toggleCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const passwordInput = this.parentElement.parentElement.querySelector('.password-input');

            if (this.checked) {
                const registration_id = this.getAttribute('data-id');
                fetchPasswordFromServer(registration_id, passwordInput);
            } else {
                passwordInput.value = '********';
            }
        });
    });


        function fetchPasswordFromServer(registration_id, passwordInput) {
        fetch('get_passwords.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'registration_id=' + registration_id,
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

      </script>

</body>

</html>
