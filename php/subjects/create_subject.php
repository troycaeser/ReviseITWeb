<?php

	include '../getConnection.php';
	require '../check_logged_in.php';

	//to create subject you need SubjectID, SubjectCode(3char 5 num), SubjectName, UserID, Dateupdated

	//this query selects teachers & coordinators, and displays only user id and names.
	$query_teachers = $db->prepare("SELECT UserID, fName, lName FROM users WHERE role = 2 OR role = 3");
	$query_teachers->execute();

	//assign variables.
	$subject_code = $_POST['subject_code'];
	$subject_name = $_POST['subject_name'];
	$selected_teacher = $_POST['subject_coordinator'];

	//get the date in Australia and assign variable
	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());

?>

<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Create Subject</title>
	</head>
	
	<body>
		<?php
			include 'subjects_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Add A Subject</h1>
			</div>

			<div class="row-fluid">
				<div class="span8">
					<form class="form-horizontal" method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
						<fieldset>
							<div class="control-group bootstro" data-bootstro-step="0" data-bootstro-placement="bottom" data-bootstro-title="The Subject Code" data-bootstro-content="Please enter the <b>subject code</b> in the textfield.">
								<label class="control-label" for="subject_code">Subject Code</label>
								<div class="controls">
									<input type="text" name="subject_code" id="subject_code" value="" />
								</div>
							</div>

							<div class="control-group bootstro" data-bootstro-step="1" data-bootstro-placement="bottom" data-bootstro-title="The Subject Name" data-bootstro-content="Please enter the <b>subject name</b> in the textfield.">
								<label class="control-label" for="subject_name">Subject Name</label>
								<div class="controls">
									<input type="text" name="subject_name" id="subject_name" value="" />
								</div>
							</div>

							<div class="control-group bootstro" data-bootstro-step="2" data-bootstro-placement="bottom" data-bootstro-title="Coordinator" data-bootstro-content="Please <b>assign a coordinator</b> for the subject, select on of the options.">
								<label class="control-label" for="subject_coordinator">Coordinator</label>
								<div class="controls">
									<?php
										//echo out the select table (this is for the user id.)
									    echo "<select name='subject_coordinator' id='subject_coordinator' multiple='multiple'>";
										    while($row = $query_teachers->fetch(PDO::FETCH_ASSOC)){
												echo("<option value = '" . $row['UserID'] . "'>". $row['fName'] ." ". $row['lName'] ."</option>");
											}
										echo "</select>";
									?>
								</div>
							</div>

							<div class="controls">
								<button class="btn bootstro" data-bootstro-step="3" data-bootstro-placement="right" data-bootstro-title="Reset" data-bootstro-content="Click this button to reset the fields to <b>blank</b>." type="submit" name="reset">Reset</button>
								<button class="btn btn-primary bootstro" data-bootstro-step="4" data-bootstro-placement="right" data-bootstro-title="Submit" data-bootstro-content="Once everything in the textfield is entered, <b>click this button</b> to add a confirm adding the subject." type="submit" name="submit">Submit</button>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="active"><a href="create_subject.php">Create Subjects</a></li>
						<li><a href="#">My account</a></li>
					</ul>
				</div>
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

<?php
	if (isset($_POST["submit"])){
		//insert subject query.
		$query_subject = $db->prepare("INSERT INTO subject VALUES(null,'".$subject_code."','".$subject_name."', '".$selected_teacher."', '".$date."')");
		$query_subject->execute();

		header("Location: all_Subjects.php");
	}
?>
