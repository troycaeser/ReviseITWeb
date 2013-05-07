<?php

	include '../getConnection.php';
	require '../check_logged_in.php';

	//to create subject you need SubjectID, SubjectCode(3char 5 num), SubjectName, UserID, Dateupdated

	//this query selects teachers & coordinators, and displays only user id and names.
	$query_teachers = $db->prepare("SELECT UserID, fName, lName FROM users WHERE role = 2 OR role = 3");
	$query_teachers->execute();

?>
<form method="post" action="create_subjects.php">
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
