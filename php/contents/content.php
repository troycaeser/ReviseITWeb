<?php
	include '../init.php';
	include '../check_logged_in.php';

	$subtopic_ID = $_GET['ID'];
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Contents</title>
	</head>
	<body>
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>View Content</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
				<?php //Inserts tables from database with information
					include'getContent.php';
				?>

				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="active"><a href="addContent.php">Add Content</a></li>
						<li><a href="editContent.php">Edit Content</a></li>
						<li><a href="deleteContent.php">Delete Content</a></li>
						<li class="divider"></li>
						<li><a href="#">About Us</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>