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

	//insert subject query.
	$query_subject = "INSERT INTO subject VALUES(null,'".$subject_code."','".$subject_name."', '".$selected_teacher."', '".$date."')";

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
				<h1>Add A Subject</h1>
			</div>

			<div class="row-fluid">
				<div class="span8">
					<form class="form-horizontal" method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="subject_code">Subject Code</label>
								<div class="controls">
									<input type="text" name="subject_code" id="subject_code" value="" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="subject_name">Subject Name</label>
								<div class="controls">
									<input type="text" name="subject_name" id="subject_name" value="" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="subject_coordinator">Coordinator</label>
								<div class="controls">
									<?php
										//echo out the select table (this is for the user id.)
									    echo "<select name='subject_coordinator' id='subject_coordinator' multiple='multiple'>";
										    while($row = mysql_fetch_array($query_teachers)){
												echo("<option value = '" . $row['UserID'] . "'>". $row['fName'] ." ". $row['lName'] ."</option>");
											}
										echo "</select>";
									?>
								</div>
							</div>

							<div class="controls">
								<button class="btn" type="submit" name="reset">Reset</button>
								<button class="btn btn-primary" type="submit" name="submit">Submit</button>
							</div>
						</fieldset>
					</form>
				</div>

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
		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>

<?php
	if (isset($_POST["submit"])){
		mysql_query($query_subject) or die(mysql_error());

		echo "1 record added";
	}
?>
