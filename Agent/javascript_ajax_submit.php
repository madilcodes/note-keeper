<?php
$host = "localhost";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$host;dbname=project_portal", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}



$response = array('success' => false);

if (isset($_POST['name']) && isset($_POST['user_name']) && $_POST['name'] != '' && $_POST['user_name'] != '') {



	$name = addslashes($_POST['name']);
	$user_name = addslashes($_POST['user_name']);

	$sql = "INSERT INTO users_complaints (message, agent_name) VALUES ('$name', '$user_name')";

	if ($conn->query($sql)) {
		$response['success'] = true;
	}
}

// Set the content type to JSON

// Output the response as JSON
echo json_encode($response);