<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	include '../check_role.php';
	checkRoleCod($_SESSION['Role']);
	checkRoleTeacher($_SESSION['Role']);
	checkRoleAdmin($_SESSION['Role']);
	$User_ID = $_GET['UserID'];
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
<br />
<br />
<div class="container">
  <div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Student home page" data-bootstro-content="Welcome to the student home page, in here you may select your subjects,and view their content!">
    <h1>Revise IT - Student Access</h1>
  </div>
  
  <div class="span6 bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Click the link below to get into the subjects page. Check out 		what subjects you're enrolled in!">
    <h3>See All Subjects!</h3>
    <p>See subjects</p>
    <a href="../subjects/all_Subjects.php" class="btn btn-primary" data-original-title="All Subjects">All Subjects</a> </div>
  
  <div class="span4 bootstro" data-bootstro-placement="bottom" data-bootstro-title="View test results" data-bootstro-content="Click on the link to view your test results">
    <h3>View test results</h3>
    <p>View all student test results!</p>
    <a href="TestResults.php?ID=<?php echo $_SESSION['UserID'];?>">View</a></div>
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
					bootstro.start(".bootstro");
				});
			});
		</script>
</body>
</html>