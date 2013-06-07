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
							<!--<li class="active"><a href="#">Sign up</a></li>-->
							<li class="active"><a href="php/student/EnterToken.php">Sign up</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<br /><br />
		
		<div class="container">
			<form id="form_login" class="form-signin" action="php/login.php" method="post">
				<h2>Please sign in</h2>
				<input type="text" class="input-block-level" id="inputUsername" placeholder="Enter Username" name="username">
				<input type="password" class="input-block-level" id="inputPassword" placeholder="Enter Password" name="password">

				<br /><br />

				<button type="submit" class="btn btn-large btn-primary pull-left">Sign in</button>
            	<a class="pull-right" href="php/admin/ResetPassword.php">Lost your password?</a>
			</form>
		</div>
		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>
