<?php

	include '../init.php';

	//to create subject you need SubjectID, SubjectCode(3char 5 num), SubjectName, UserID, Dateupdated

	//this query selects teachers & coordinators, and displays only user id and names.
	$query_teachers = mysql_query("SELECT UserID, fName, lName FROM users WHERE role = 2 OR role = 3");

	//assign variables.
	$subject_code = $_POST['subject_code'];
	$subject_name = $_POST['subject_name'];
	$selected_teacher = $_POST['subject_coordinator'];

	//get the date in Australia and assign variable
	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());

	//UPDATE SUBJECT QUERY
	$query_update_subject = "INSERT INTO subject VALUES(null,'".$subject_code."','".$subject_name."', '".$selected_teacher."', '".$date."')";

?>

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

			<div class="page-header">
				<h1>Update Subject Information</h1>
			</div>

			<div class="row-fluid">
				<?php
					include 'edit_subject_container.php';
				?>
			</div>
		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>