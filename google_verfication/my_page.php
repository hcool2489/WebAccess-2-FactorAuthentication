<?php
include("connection.php");
if(empty($_SESSION['user_id']))
{
	echo "<script> window.location = 'index.php'; </script>";
}

$user_id = $_SESSION['user_id'];
$user_result = mysql_query("select * from tbl_users where user_id='$user_id'") or die(mysql_error());
$user_row = mysql_fetch_array($user_result);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>2-Step Verification using Google Authenticator</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app_style.css" charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<h1>Hi <?php echo ucfirst($user_row['profile_name']); ?>,</h1>
			
			<table class="user-table">
				<tr><td colspan="3" align="center" class="title">User Profile Details:</td></tr>
				<tr><th>Profile Name</th><td><?php echo $user_row['profile_name']; ?></td></tr>
				<tr><th>Email</th><td><?php echo $user_row['email']; ?></td></tr>
				<tr><th>Secret Key</th><td><?php echo $user_row['google_auth_code']; ?></td></tr>
				<tr><td colspan="3" align="center"><a href="logout.php" class="btn btn-xs btn-danger" >Logout</a></td></tr>
			</table>
			<h4></h4>
		</div>
	</body>
</html>