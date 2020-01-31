<?php
include('connection.php');
require_once 'googleLib/GoogleAuthenticator.php';
$gauth = new GoogleAuthenticator();

if(empty($_SESSION['user_id']))
{
	echo "<script> window.location = 'index.php'; </script>";
}

$user_id = $_SESSION['user_id'];
$user_result = mysql_query("select * from tbl_users where user_id='$user_id'") or die(mysql_error());
$user_row = mysql_fetch_array($user_result);

$secret_key	= $user_row['google_auth_code'];
$email		= $user_row['email'];

$google_QR_Code = $gauth->getQRCodeGoogleUrl($email, $secret_key,'GROUP-5');
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

			<p>Scan with Google Authenticator application on your smart phone.</p>
			<div id="img"><img src='<?php echo $google_QR_Code; ?>' /></div>

			<form id="LI-form">
			<input type="hidden" id="process_name" name="process_name" value="verify_code" />
				<div class="form-group">
					<label for="email">Place your code here:</label>
					<input type="text" name="scan_code" class="form-control" id="scan_code" required />
				  </div>
				  
				<input type="button" class="btn btn-success btn-submit" value="Verify Code"/>
			</form>
			</div>
			<div style="text-align:center">
				<h6>Download Google Authenticator <br/> application using this link(s),</h6>
			<a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"><img class='app' src="images/iphone.png" /></a>

			<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><img class="app" src="images/android.png" /></a>
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
