<?php

	include '../getConnection.php';
	include '../check_logged_in.php';

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
			include 'accounts_menu_bar.php';
		?>
		
		<br /><br />

		<div class="container">

			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Welcome to the subjects page!">
				<h1>My Account Information</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
				<?php
					include 'accounts.php';
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