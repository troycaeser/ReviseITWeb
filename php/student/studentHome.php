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
    <div class="row-fluid">
      <div class="span6">
        <h3>See All Subjects!</h3>
        <p>See subjects</p>
        <a href="../subjects/all_Subjects.php" class="btn btn-primary" rel="popover" data-original-title="All Subjects">All Subjects</a>
      </div>
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