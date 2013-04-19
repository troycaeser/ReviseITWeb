<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
	<head>
			<?php
				include '../header_container.php';
			?>
			<title>ReviseIT - Subjects</title>
	</head>
	<body>
		<?php
			include 'subjects_menu_bar.php';
		?>
		
		<br /><br />

		<div class="container">

			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Welcome to the subjects page!">
				<h1>All Subjects</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
				<?php
					include 'subjects.php';
				?>

				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="bootstro" data-bootstro-placement="left" data-bootstro-title="Create Subjects!" data-bootstro-content="Click this link to <b>create subjects page</b>!"><a href="create_subject.php">Create Subjects</a></li>
						<li><a href="#">My account</a></li>
						<li class="divider"></li>
						<li><a href="#">About Us</a></li>
					</ul>
				</div>
			</div>
			
			<!-- This drop down button isn't working, commented out for future use.-->
			<!--
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
			-->

		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
		<script src="../../assets/js/bootstro.min.js"></script>
		<script>
		$(document).ready(function(){

		
			$('#help').click(function(){
				bootstro.start(".bootstro", {
					finishButton: ''
				});
				//$('#example').popover({trigger: "hover"});
			});
		});
		</script>
	</body>
</html>