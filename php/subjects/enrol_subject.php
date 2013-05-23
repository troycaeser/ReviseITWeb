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
			<title>ReviseIT - Enrol A Student</title>
	</head>
	<body>
		<?php
			include 'subjects_menu_bar.php';
		?>
		
		<br /><br />

		<div class="container">

			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Welcome to the subjects page!">
				<h1>Enrol</h1>
			</div>
			
			<div class='row-fluid'>
				<div class='span4'>
					<form>
						<fieldset>
							<div class="control-group bootstro" data-bootstro-step="0" data-bootstro-placement="bottom" data-bootstro-title="The Subject Code" data-bootstro-content="Please enter the <b>subject code</b> in the textfield.">
								<label class="control-label" for="key_word">Enter Keyword</label>
								<div class="controls">
									<input type="text" name="keyword" id="id_keyword" />
								</div>
							</div>

							<div class="controls">
								<button class="btn btn-primary bootstro" data-bootstro-step="4" data-bootstro-placement="right" data-bootstro-title="Submit" data-bootstro-content="Once everything in the textfield is entered, <b>click this button</b> to add a confirm adding the subject." type="button" onclick='myCall();'>Search</button>
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
				bootstro.start(".bootstro", {
					finishButton: ''
				});
			});
		});
		</script>
		<script>

		    function myCall() {
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