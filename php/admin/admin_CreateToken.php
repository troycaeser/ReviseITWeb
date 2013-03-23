<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width-device-width, initial-scale=1.0">
			<title>ReviseIT - Create Token</title>
			<link rel="stylesheet" href="../../assets/css/version1.css">
			<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
	</head>
	<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-th-list"></span>
					</a>
					<a href="#" class="brand">reviseIT</a>
					<p class="nav navbar-text">user type: <strong>administrator</strong></p>
					<div class="nav-collapse collapse">
						<ul class="nav pull-right">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Accounts</a></li>
							<li><a href="#">Subjects</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<br /><br />

		<div class="container">
			<?php
				include '../welcome.php';
			?>

			<div class="page-header">
				<h1>Create Token</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays Links -->
				<?php
					include'CreateToken.php';
				?>
			</div>
		</div>
		
		<!-- This is the same as the navigation bar at the top, except I used it for the footer.-->
		<div class="navbar navbar-fixed-bottom">
			<div class="container">
				<ul class="nav pull-right">
					<li><a href="#">Log out</a></li>
					<li><a href="#">Help</a></li>
				</ul>
			</div>
		</div>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../assets/js/bootstrap.js"></script>
	</body>
</html>