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
		<title>ReviseIT - Delete Content</title>
	</head>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Delete content for a subtopic</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                    <form action="deleteCont.php" method="get"><!--Posts info into url-->
                        <div class="row-fluid">
                            <div class='span2'><h4>Subtopic ID</h4></div><div class='span6'><input type="text" name="subId"></div>
                        </div>
                        <input type="submit">
                    </form> 
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