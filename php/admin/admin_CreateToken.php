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
		<title>ReviseIT - Create Token</title>
	</head>
	<body>
		<?php
			include 'admin_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Create Token</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays Links -->
				<?php
					include 'CreateToken.php';
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