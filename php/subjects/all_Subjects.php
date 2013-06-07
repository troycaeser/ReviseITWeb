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

					if($_SESSION['Role'] != 4 && $_SESSION['Role'] != 3){
						echo "<div class='span4'>";
							echo "<a class='btn' data-toggle='collapse' data-target='#create_form'>Create Subjects</a>";
							echo "<div id='create_form' class='collapse div'>";
								include 'create_subject.php';
							echo "</div>";
						echo "</div>";
					}
				?>
			</div>
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
			$('#help').click(function()
			{
				bootstro.start(".bootstro");
			});

			$('html').click(function(e) {
			    $('.popups').popover('hide');
			});

			$('.popups').popover({
			    html: true,
			    trigger: 'manual',
			}).click(function(e) {
			    $(this).popover('toggle');
			    e.stopPropagation();
			});
  
        	$(".collapse").collapse({
        		toggle: false
        	});

		    /*$("a[rel=popover]")
            .popover({
                offset: 10,
                trigger: 'manual',
                animate: false,
                html: true,
                placement: 'right',
                content: '<button class="btn btn-success" id="edit">Edit</button>' + '<button class="btn btn-danger" id="delete">delete</button>',
                template: '<div class="popover" onmouseover="$(this).mouseleave(function() {$(this).hide(); });"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
            }).mouseenter(function(e) {
                $(this).popover('show');
            });*/
		});
		</script>
	</body>
</html>