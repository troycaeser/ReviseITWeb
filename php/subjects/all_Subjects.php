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
				<a href="#" rel="popover" class="btn" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="" data-original-title="Popover on top">Popover on top</a>
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
		<script src="../../assets/js/bootstro.js"></script>
		<script>
		$(document).ready(function(){

		
			$('#help').click(function(){
				bootstro.start(".bootstro", {
					finishButton: ''
				});
				//$('#example').popover({trigger: "hover"});
			});

		    $("a[rel=popover]")
            .popover({
                offset: 10,
                trigger: 'manual',
                animate: false,
                html: true,
                placement: 'left',
                template: '<div class="popover" onmouseover="$(this).mouseleave(function() {$(this).hide(); });"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'

            }).click(function(e) {
                e.preventDefault() ;
            }).mouseenter(function(e) {
                $(this).popover('show');
            });
		});
		</script>
	</body>
</html>