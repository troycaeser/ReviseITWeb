<?php
	include '../init.php';
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
			<?php
				include '../welcome.php';
			?>

			<div class="page-header">
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
	</body>
</html>
