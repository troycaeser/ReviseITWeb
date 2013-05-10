<?php //not in use
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
			<?php
				include '../welcome.php';
			?>

			<div class="page-header">
				<h1>Edit Content for a subtopic</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                    <form action="editContent2.php" method="get"> <!-- Posts value into the url for later use-->
                        <div class="row-fluid">
                            <div class='span2'><h4>Subtopic ID</h4></div><div class='span6'><input type="text" name="subId"></div>
                        </div>
                    <input type="submit">
                    </form> 
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