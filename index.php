<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale=1.0">
		<title>Login Page</title>
		<link rel="stylesheet" href="assets/css/version1.css">
		<link rel="stylesheet" href="assets/css/bootstrap-responsive.css">
	</head>
	<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-th-list"></span>
					</a>
					<a href="#" class="brand">reviseIT</a>
					<div class="nav-collapse collapse">
						<ul class="nav pull-right">
							<li class="active"><a href="#">Sign up</a></li>
							<!--<li class="active"><a href="php/student/EnterToken.php">Sign up</a></li>-->
						</ul>
					</div>
				</div>
			</div>
		</div>

		<br /><br />
		
		<div class="container">
			<div class="page-header text-center">
				<h1>Log in</h1>
			</div>
			
			<form id="form_login" class="form-horizontal" action="php/login.php" method="post">
				<div class="center">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="inputUsername">Username: </label>
							<div class="controls">
								<input type="text" id="inputUsername" name="username">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="inputPassword">Password: </label>
							<div class="controls">
								<input type="password" id="inputPassword" name="password">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
                            	<!--<a href="php/admin/ResetPassword.php">Reset Password</a>-->
                            	<a href="#">Reset Password</a>
								<button type="submit" class="btn">Sign in</button>
							</div>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>
