<!DOCTYPE html>
<html>

<head>
    <title>Edit File</title>
    <link rel="icon" href="../favicon.jpg" type="image/jpeg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body class='text-center'>
    <h2>Editing File :-<?php echo  $_GET['file'];?></h2>
    <?php
if (isset($_GET['file'])) {
    $file = '../TextFiles/' . $_GET['file'];
    if (file_exists($file)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newContent = $_POST['content'];
            file_put_contents($file, $newContent);
            echo '<script>
                    swal({
                        title: "Success",
                        text: "File updated successfully.",
                        icon: "success",
                        timer: 3000,  // 3 seconds
                        buttons: false  // no close button
                    }).then(function() {
                        window.location = "list.php";
                    });
                  </script>';
        }
        $content = file_get_contents($file);
        ?>
        <form method="POST">
            <textarea name="content" rows="20" cols="160"><?php echo htmlspecialchars($content); ?></textarea><br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <input class='btn btn-success' title='Save file' type="submit" value="Save">
                <a class='btn btn-warning' title='Back to File List' href="list.php">Back</a>
            </div>
        </form>
        <?php
    } else {
        echo '<script>
                swal({
                    title: "Error",
                    text: "File not found.",
                    icon: "error",
                    timer: 3000,  // 3 seconds
                    buttons: false  // no close button
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
                timer: 3000,  // 3 seconds
                buttons: false  // no close button
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