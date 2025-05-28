
<?php
session_start();
include 'dbconnection.php';
$session_name = $_SESSION['admin'];
if ($session_name == "") {
  header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Files</title>
    <link rel="icon" href="favicon.jpg" type="image/jpeg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
    <style>
        p{
            color:green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="main" class="text-center">
        <h2>KEEP NOTES </h2>
        <div>
            <form method="post">
                <br>
                <marquee onmouseover="this.stop();" onmouseout="this.start();">
                <p >Files will be saved with a .txt extension by default. You can change the extension <a href="list.php">Here.</a></p>
                </marquee>
                <textarea input="text" name="comments" rows="15" cols="160" required></textarea><br>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-danger" type="submit" name="submit">Submit</button>
                    <a class="btn btn-warning" href='admin_panel.php' title='Back to Dashbord'>Home</a>
                    <a class='btn btn-primary' title='Refresh' href="files.php">Refresh</a>
                </div>
            </form>
        </div>
    </div>
    <?php

    $successMessage = '';
    date_default_timezone_set('Asia/Kolkata');
    $time = date("Y-m-d-H-i-s");

    if (isset($_POST['submit'])) {
        $comments = $_POST['comments'];
        $nextlevelFolder = "TextFiles/";
        $filename = $nextlevelFolder . 'New-' . $time . '.txt';
        $file = fopen($filename, "w") or die("Unable to create the file");
        if (fwrite($file, $comments)) {
            $relativeURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $filename);
            $successMessage = 'File created successfully: <a target="_blank" href="' . $relativeURL . '">' . basename($filename) . '</a>';
        }
        fclose($file);
    }

    if (!empty($successMessage)): ?>
        <div class="text-center">
            <p style="color: green;">
                <?php echo $successMessage; ?>
            </p>
        </div>
    <?php endif; ?>
</body>
</html>