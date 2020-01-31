<?php
include('connection.php');
require_once 'googleLib/GoogleAuthenticator.php';

if(empty($_SESSION['user_id']))
{
	echo "<script> window.location = 'index.php'; </script>";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>2-Step Verification using Google Authenticator</title>
		<link rel="stylesheet" type="text/css" href="css/app_style.css" charset="utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="container">
			<h1>2-Step Verification using Google Authenticator</h1>
			<div id='device'>
			<form id="LI-form">
			<input type="hidden" id="process_name" name="process_name" value="verify_code" />
				<div class="form-group">
					<label for="email">Place your code here:</label>
					<input type="text" name="scan_code" class="form-control" id="scan_code" required />
				  </div>
				<input type="button" class="btn btn-success btn-submit" value="Verify Code"/>
			</form>
			</div>
		</div>
		
	<script src="js/jquery.validate.min.js"></script>

	<script>
		$(document).ready(function(){
			/* submit form details */
			$(document).on('click', '.btn-submit', function(ev){
				if($("#LI-form").valid() == true){
					var data = $("#LI-form").serialize();
					$.post('check_user.php', data, function(data,status){
						console.log("submitnig result ====> Data: " + data + "\nStatus: " + status);
						if( data == "done"){
							window.location = 'my_page.php';
						}
						else{
							alert("not done");
						}
						
					});
				}
			});
			/* ebd submit form details */
		});
	</script>
	</body>
</html>
