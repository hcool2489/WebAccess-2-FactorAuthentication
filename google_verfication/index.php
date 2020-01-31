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
<div class="container">
    <h1>2-Step Verification using Google Authenticator</h1>
	
	<div class="row">
		<div class="col-md-offset-1 col-md-4">
			<h3>Registration</h3>
			<form name="signup-form" id="signup-form">
			<input type="hidden" id="process_name" name="process_name" value="user_registor" />
			  <div class="errorMsg errorMsgReg"></div>
			  <div class="form-group">
				<label for="email">Full Name:</label>
				<input type="text" name="reg_name" class="form-control" id="reg_name" required />
			  </div>
			  <div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="reg_email" class="form-control" id="reg_email" required />
			  </div>
			  <div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="reg_password" class="form-control" id="reg_password" required />
			  </div>
			  
			  <button type="button" class="btn btn-primary btn-reg-submit">Submit</button>
			</form>

		</div>

		<div class="col-md-offset-1 col-md-4">
			<h3>Login</h3>
			<form name="login-form" id="login-form">
			<input type="hidden" id="process_name" name="process_name" value="user_login" />
			  <div class="errorMsg errorMsgReg"></div>
			  <div class="form-group">
				<label for="login_email">Email:</label>
				<input type="email" name="login_email" class="form-control" id="login_email" required />
			  </div>
			  <div class="form-group">
				<label for="login_password">Password:</label>
				<input type="password" name="login_password" class="form-control" id="login_password" required />
			  </div>
			  
			  <button type="button" class="btn btn-success btn-login-submit">Login</button>
			</form>
			
		</div>
	</div>
</div>

<script src="js/jquery.validate.min.js"></script>

<script>
	$(document).ready(function(){
		/* submit form details */
		$(document).on('click', '.btn-reg-submit', function(ev){
			if($("#signup-form").valid() == true){
				var data = $("#signup-form").serialize();
				$.post('check_user.php', data, function(data,status){
					console.log("submitnig result ====> Data: " + data + "\nStatus: " + status);
					if( data == "done"){
						window.location = 'user_confirm.php';
					}
					else{
						alert("not done");
					}
					
				});
			}
		});
		/* ebd submit form details */
		
		/* submit form details */
		$(document).on('click', '.btn-login-submit', function(ev){
			if($("#login-form").valid() == true){
				var data = $("#login-form").serialize();
				$.post('check_user.php', data, function(data,status){
					console.log("submitnig result ====> Data: " + data + "\nStatus: " + status);
					if( data == "done"){
						window.location = 'user_login_confirm.php';
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
