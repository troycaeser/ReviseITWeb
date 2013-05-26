<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	include '../check_role.php';
	checkRoleCod($_SESSION['Role']);
	checkRoleTeacher($_SESSION['Role']);
	checkRoleAdmin($_SESSION['Role']);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Student</title>
	</head>
	<body>
		<?php
			include 'student_menu_bar.php';
		?>

		<br /><br />

		<div class="container">
			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Student home page" data-bootstro-content="Welcome to the student home page, in here you may select your subjects,and view their content!">
				<h1>Revise IT - Student Access</h1>
			</div>
			<div class="row-fluid">
				<div class="row-fluid">
					<div class="span6 bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Click the link below to get into the subjects page. Check out what subjects you're enrolled in!">
						<h3>See All Subjects!</h3>
						<p>See subjects</p>
						<a href="../subjects/all_Subjects.php" class="btn btn-primary" data-original-title="All Subjects">All Subjects</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<?php
			include '../footer.php';
		?>
		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
		<script src="../../assets/js/bootstro.js"></script>
		<script>
			$(document).ready(function(){
				$('#help').click(function(){
					bootstro.start(".bootstro", {
						finishButton: ''
					});
				});
			});
		</script>
	</body>
</html>