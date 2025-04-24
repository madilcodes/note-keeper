<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'con.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (!isset($_POST['username']) || empty($_POST['username'])) {
        die("Error: Username is not set.");
    }

    $user_name = $_POST['username']; 

    $target_dir = "uploads/";

   
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Error: Failed to create upload directory.");
        }
    }

    
    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES["profile_pic"]["tmp_name"];
        $file_name = basename($_FILES["profile_pic"]["name"]);
        $file_size = $_FILES["profile_pic"]["size"];
        $file_type = $_FILES["profile_pic"]["type"];

        
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed_types)) {
            die("Error: Only JPG, PNG, and GIF files are allowed.");
        }

        
        $max_size = 2 * 1024 * 1024; 
        if ($file_size > $max_size) {
            die("Error: File size exceeds the 2MB limit.");
        }

        
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = $user_name . "_" . time() . "." . $file_ext;
        $target_file = $target_dir . $new_file_name;

        
        if (move_uploaded_file($file_tmp, $target_file)) {
           
            $stmt = $con->prepare("UPDATE registration_details SET profile_pic = ? WHERE Name = ?");
            if (!$stmt) {
                die("Error: " . $con->error);
            }

            $stmt->bind_param("ss", $new_file_name, $user_name);
            if ($stmt->execute()) {
             
                header("Location: user_panel.php");
                exit();
            } else {
                die("Error: Could not update the profile picture in the database.");
            }

            $stmt->close();
        } else {
            die("Error: Failed to move the uploaded file.");
        }
    } else {
        die("Error: " . $_FILES["profile_pic"]["error"]);
    }
}

$con->close();
?>