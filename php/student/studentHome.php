<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<title>ReviseIT - Student</title>
		<?php
			include '../header_container.php';
		?>
</head>
<body>
<?php
	include 'student_menu_bar.php';
?>
<br />
<br />
<div class="container">
  <div class="page-header">
    <h1>Revise IT - Student Access</h1>
  </div>
  <div class="row-fluid">
    <div class="span8">
      <div class="row-fluid">
        <div class="span3">
          <h3>Create an Account!</h3>
          <p>Enter a token and register an account!</p>
          <a href="EnterToken.php" class="btn btn-primary" rel="popover" data-original-title="Register">Register</a> </div>
        <div class="span3">
          <h3>Enrol in Subject</h3>
          <p>Obtain access to a subject and it's content!</p>
          <a>Enrol</a> </div>
        <div class="span3">
          <h3>View Content</h3>
          <p>Access Revision Content and Tests!</p>
          <a href="../subtopics/ViewTestQuestions.php">View Content</a> </div>
        <div class="span3">
          <h3>View Test Results</h3>
          <p>View Previous Test Results!</p>
          <a>Results</a> </div>
      </div>
    </div>
    <div class="span4">
      <ul class="nav nav-list">
        <li class="nav-header">Quick Access</li>
        <li><a href="../account/my_account.php">My Account</a></li>
        <li><a href="#">Contact Admin</a></li>
      </ul>
    </div>
  </div>
</div>
<?php
	include '../footer.php';
?>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/bootstro.min.js"></script>
		<script>
		$(document).ready(function(){

		
			$('bootstroTest').click(function(){
				bootstro.start(".bootstro");
				//$('#example').popover({trigger: "hover"});
			});
		});
		</script>
</body>
</html>