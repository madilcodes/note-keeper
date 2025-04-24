<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($_POST['username']) || empty($_POST['username'])) {
        echo json_encode([
            "success" => false,
            "message" => "Username is not set."
        ]);
        exit();
    }

    $user_name = $_POST['username'];  

    
    $stmt = $con->prepare("UPDATE registration_details SET profile_pic = 'default.jpg' WHERE Name = ?");
    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Prepare failed: " . $con->error
        ]);
        exit();
    }

    $stmt->bind_param("s", $user_name);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Execute failed: " . $stmt->error
        ]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}
?>