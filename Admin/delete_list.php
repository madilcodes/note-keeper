<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Deletion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>

<?php
if (isset($_GET['file'])) {
    $file = '../TextFiles/' . $_GET['file'];
    if (file_exists($file)) {
        unlink($file);
        echo '<script>
                swal({
                    title: "Success",
                    text: "File deleted successfully",
                    icon: "success",
                    timer: 3000,  
                    buttons: false  
                }).then(function() {
                    window.location = "list.php";
                });
              </script>';
    } else {
        echo '<script>
                swal({
                    title: "Error",
                    text: "File not found.",
                    icon: "error",
                    timer: 3000,  
                    buttons: false  
                }).then(function() {
                    window.location = "list.php";
                });
              </script>';
    }
} else {
    echo '<script>
            swal({
                title: "Error",
                text: "No file selected.",
                icon: "error",
                timer: 3000,  
                buttons: false  
            }).then(function() {
                window.location = "list.php";
            });
          </script>';
}
?>

<noscript>
    <br><a href="list.php">Back to File List</a>
</noscript>

</body>
</html>

