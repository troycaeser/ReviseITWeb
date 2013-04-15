<?php

	include '../getConnection.php';
	require '../check_logged_in.php';
	
	$subject_ID = $_GET['ID'];
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
							<li><a href="all_Subjects.php">Subjects</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<br /><br />

		<div class="container">
        <?php	
		
		$topic_ID = $_GET['id'];
        if (isset($_GET['id']) && is_numeric($_GET['id']))
	 	{
			try
			{
				// Delete the entry
				$result = $db->prepare("DELETE FROM subject WHERE SubjectID='".$topic_ID."'");
				$result->execute();
			}
			catch(PDOExcepiton $e)
			{
				echo $e->getMessage();
			}
				
			 // Redirect back to the view page
			 header("Location: all_subjects.php");
		}
		else
		// If id isn't set, or isn't valid, redirect back to the view page
		{
			header("Location: all_subjects.php");
		}
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
		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>
