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
		<title>ReviseIT - Admin</title>
	</head>
	<body>
		<?php
			include 'admin_menu_bar.php';
		?>

		<br /><br />

		<div class="container">
			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="The Help System" data-bootstro-content="Not sure what to do? No worries, just <b>click next</b> and we will walk you through the ReviseIT web app. Otherwise, click outside the box. You may use the arrow keys.">
				<h1>What would you like to do?</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays Links -->
				<?php
					include'admin_container.php';
				?>
			</div>
		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
		<script src="../../assets/js/bootstro.min.js"></script>
		<script>
		$(document).ready(function()
		{
			$('#help').click(function()
			{
				bootstro.start(".bootstro", 
				{
					finishButton: ''
				});
			});
		});
		</script>
	</body>
</html>
