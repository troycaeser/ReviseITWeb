<?php
	include '../init.php';
?>

<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width-device-width, initial-scale=1.0">
			<title>ReviseIT - Teacher</title>
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
				include '../php/welcome.php';
			?>

			<div class="page-header">
				<h1>All Subjects</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
				<?php
					include'subjects.php';
				?>

				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="active"><a href="create_subject.php">Create Subjects</a></li>
						<li><a href="#">Account details</a></li>
						<li><a href="#">My account</a></li>
						<li class="divider"></li>
						<li><a href="#">About Us</a></li>
					</ul>
				</div>
			</div>

			<div class="btn-group">
			    <button class="btn dropdown-toggle" data-toggle="dropdown">
			      Action
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href='delete_subject.php'>Delete</a></li>
			      <li><a href='edit_subject.php'>Edit</a></li>
			    </ul>
			</div>

		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
	</body>
</html>