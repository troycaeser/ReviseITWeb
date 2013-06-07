<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	include '../check_role.php';
	checkRoleStudent($_SESSION['Role']);
?>

<!DOCTYPE html>
<html>
	<head>
			<?php
				include '../header_container.php';
			?>
			<title>ReviseIT - Enrol A Student</title>
	</head>
	<body>
		<?php
			include 'subjects_menu_bar.php';
		?>
		
		<br /><br />

		<div class="container">

			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Enolment" data-bootstro-content="Welcome to the enrolment page! In here you may <b><i>search</i></b> for a <b>student</b> and enrol them!">
				<h1>Enrol</h1>
			</div>
			
			<div class='row-fluid'>
				<div class='span4'>
					<form>
						<fieldset>
							<div class="control-group bootstro" data-bootstro-placement="bottom" data-bootstro-title="Key word" data-bootstro-content="Please Enter a keyword to search for the student you'd like to enrol, The keyword can vary from their <b>first name</b>, <b>last name</b> and <b>username</b>.">
								<label class="control-label" for="key_word">Enter Keyword</label>
								<div class="controls">
									<input type="text" name="keyword" id="id_keyword" />
								</div>
							</div>

							<div class="controls">
								<button class="btn btn-primary bootstro" data-bootstro-placement="right" data-bootstro-title="Search for a student" data-bootstro-content="Once everything in the textfield is entered, <b>click this button</b> to search for a student." type="button" onclick='myCall();'>Search</button>
							</div>
						</fieldset>
					</form>
				</div>
				<div class='span8' id='id_search_Result'>
				</div>
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
			$('#help').click(function(){
				bootstro.start(".bootstro");
			});
		});
		</script>
		<script>
		    function myCall(){
		        var request = $.ajax({
		            type: "POST",
		            url: "search_student.php",
		            data: {keywordValue: $('#id_keyword').val(), userID: <?php echo $_SESSION['UserID']?>}
		        });
		        request.done(function(msg) {
		            $("#id_search_Result").html(msg);          
		        });
		 
		        request.fail(function(jqXHR, textStatus) {
		            alert( "Request failed: " + textStatus );
		        });
		    }
		</script>
	</body>
</html>