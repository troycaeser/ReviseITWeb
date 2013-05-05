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
				<h1>test content</h1>
			</div>
			
			<div class='row-fluid'>
				<form>
					<textarea id="some-textarea" class="textarea" placeholder="Enter text ..."></textarea>
				</form>
			</div>
		</div>
		
		<!-- Footer -->
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
		<script src="../../assets/js/bootstro.min.js"></script>
		<!-- wysihtml5 parser rules -->
		<script src="../../assets/js/parser_rules/advanced.js"></script>
		<!-- Library -->
		<script src="../../assets/js/dist/wysihtml5-0.3.0.min.js"></script>
		<script src="../../assets/js/bootstrap-wysihtml5-0.0.2.js"></script>
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
		<script>
			var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
			  toolbar:      "wysihtml5-toolbar", // id of toolbar element
			  parserRules:  wysihtml5ParserRules // defined in parser rules set 
			});
		</script>
		<script type="text/javascript">
			$('.textarea').wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": false //Button to change color of font  
			});
		</script>
	</body>
</html>
