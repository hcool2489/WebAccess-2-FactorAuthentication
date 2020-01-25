<?php
	include connection.php;
	
	if($_POST['user']){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		
	}
?>
<form method="post" action="login.php">
	<label>UserName: <input required type="text" name="user" placeholder="UserName"></label></br>
	<label>Password: <input required type="text" name="pass" placeholder="Password"></label></br>
	<input type="submit" value="Login">
</form>