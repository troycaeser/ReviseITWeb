<?php
	include '../init.php';
	include '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Edit Content</title>
	</head>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Edit content for a subtopic</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                    <?php
					include '../init.php';
					
					//execute editContent function
					echo editContent();

					function editContent()
					{
						//get the values out of the url and assign them to varibles
						$subid =  $_GET["sub"];
						$content = $_GET["cont"];
						
						//creates sql query string
						$str = "UPDATE `subtopic` SET `Content`='".$content."' WHERE SubtopicID = '".$subid."'";
						
						//runs sql and updates content
						mysql_query($str) or die(mysql_error());
						echo 'Successfully edited Content';
					}
					?>
                </div>

				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="active"><a href="#">Create Accounts</a></li>
						<li><a href="#">Subject Roles</a></li>
						<li><a href="#">Account details</a></li>
						<li><a href="#">My account</a></li>
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


