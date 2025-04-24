<?php
session_start();
$username = $_SESSION['username'];
if ($username == '') {

  header("Location: .././user.php");

}

?>
<html>
<head>
	<title>javascript form ajax</title>
	<link rel="icon" href="../favicon.jpg" type="image/jpeg">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		.center {
			margin: auto;
			width: 60%;
			border: 3px solid #73AD21;
			padding: 10px;
		}
	</style>
</head>

<body>
	<div class="center">
		<div id="message">
			<form action="" method="post">
				<div class="form-control">
					<lable>USER ID:</lable><br>

					<input type="text" name="user_name" value="<?=$username?>" readonly/>

					<label>INSERT YOUR COMPLAINT HERE: </label>

					<input type="text" name="name" value="" />

				</div>

				<div style="margin: 10px;"><input style="color:white;background-color: darkgreen;" type="button"
						onclick="submitForm();" name="save_contact" value="Submit" />
					<button style="background-color: blue; color:azure;" href="javascript_ajax.php">Refresh</button>
				</div>
			</form>
		</div>
</body>
<script type="text/javascript">


	function submitForm() {
		// Get values from the input fields
		var user_name = $('input[name=user_name]').val(); // Updated selector
		var name = $('input[name=name]').val();

		if (name !== '') {
			// Create a data object containing both values
			var formData = {
				name: name,
				user_name: user_name
			};

			// Display a "Processing form" message
			$('#message').html('<span style="color: red">Processing form... Please wait...</span>');

			// Send an AJAX POST request
			$.ajax({
				url: "./././javascript_ajax_submit.php",
				type: 'POST',
				data: formData,
				success: function (response) {
					var res = JSON.parse(response);
					console.log(res);



					if (res.success == true) {
						$('#message').html('<span style="color: green">Complaint submitted successfully</span>');

						// Close the tab after 3 seconds
						setTimeout(function () {
							window.close();  // Close the current tab
						}, 3000);
					} else {
						$('#message').html('<span style="color: red">Complaint not submitted. Some error in running the database query.</span>');
					}
				},
				error: function () {
					$('#message').html('<span style="color: red">An error occurred while submitting the form.</span>');
				}
			});
		} else {
			$('#message').html('<span style="color: red">Please fill in the fields</span>');
		}
	}

</script>

</html>