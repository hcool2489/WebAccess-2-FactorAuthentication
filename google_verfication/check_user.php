<?php
include("connection.php");

require_once 'googleLib/GoogleAuthenticator.php';
$gauth = new GoogleAuthenticator();
$secret_key = $gauth->createSecret();

$process_name = $_POST['process_name'];



if($process_name == "user_registor"){
	$reg_name		= $_POST['reg_name'];
	$reg_email		= $_POST['reg_email'];
	$reg_password	= md5($_POST['reg_password']);
    
	$chk_user = mysql_query("select * from tbl_users where email='$reg_email'") or die(mysql_error());
	if(mysql_num_rows($chk_user) == 0){
    	$query = "insert into tbl_users(profile_name, email, password, google_auth_code) values('$reg_name', '$reg_email', '$reg_password', '$secret_key' )";
		$result = mysql_query($query) or die(mysql_error());
		$_SESSION['user_id'] = mysql_insert_id();
		echo "done";
    }
    else{
		echo "This Email already exits in system.";
    }
}

if($process_name == "user_login"){
	$login_email		= $_POST['login_email'];
	$login_password		= md5($_POST['login_password']);
    
	$user_result = mysql_query("select * from tbl_users where email='$login_email' and password='$login_password'") or die(mysql_error());
	if(mysql_num_rows($user_result) == 1){
    	$user_row = mysql_fetch_array($user_result);
		$_SESSION['user_id'] = $user_row['user_id'];
		echo "done";
    }
    else{
		echo "Check your user login details.";
    }
}

if($process_name == "verify_code"){
	$scan_code = $_POST['scan_code'];
	$user_id = $_SESSION['user_id'];
	
	$user_result = mysql_query("select * from tbl_users where user_id='$user_id'") or die(mysql_error());
	$user_row = mysql_fetch_array($user_result);
	$secret_key	= $user_row['google_auth_code'];
	
	$checkResult = $gauth->verifyCode($secret_key, $scan_code, 2);    // 2 = 2*30sec clock tolerance

	if ($checkResult){
		$_SESSION['googleVerifyCode'] = $scan_code;
		echo "done";
	} 
	else{
		echo 'Note : Code not matched.';
	}
}
?>