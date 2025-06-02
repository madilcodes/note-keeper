<?php
session_start();
$session_name = $_SESSION['admin'];
//if ($session_name == "") {
//  header("Location: admin.php");
//}
?>

<!DOCTYPE html>
<html>

<head>
    <title>OTP-Generator </title>
    <link rel="icon" href="../../favicon.jpg" type="image/jpeg">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        body {
            background-color: antiquewhite;

        }

        span {
            color: red;
        }

        .box {
            padding: 80px;
            box-shadow: 0 0 15px rgba(160, 43, 43, 0);
            font-size: 20px;
            text-align: center;
            color: black;
        }

        .btn {
            background-color: rgb(187, 196, 106);
            padding: 15px;
            font-size: 10px;
            width: 150px;
            color: white;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>

</head>

<body class="bg-info">



    <br>

    <button class="btn btn-primary" onclick="generateOTP()">Generate OTP</button>

    <div id="name"> <br>
        <input type="button" class="btn btn-danger" onclick="show()" value="Enter OTP">
    </div>
    <div> <br>
        <a class="btn btn-warning" href='../admin_panel.php' title='Back to Dashbord'>Home</a>

    </div>
    <div></div>
    <div class="box">
        Dear Customer ,Your OTP For Registration is :--<span id="otp"></span>

    </div>
</body>



<script>
    function generateOTP() {

        let digits = '0123456789';
        let OTP = '';
        for (let i = 0; i < 4; i++) {
            OTP += digits[Math.floor(Math.random() * 10)];
        }
        document.getElementById('otp').innerHTML = OTP;
    }



    function show() {
        var name = prompt("Enter Your OTP Here");

        $.ajax({
            url: './././javascript/save_otp.php',
            type: 'POST',
            data: { "name": name },
            success: function (response) {
                console.log(response);
            }
        })

        if (name) {
            alert("YOUR OTP HAS BEEN SAVED");
        } else {
            alert("Sorry OTP not save!");
        }

    }
</script>

</html>
