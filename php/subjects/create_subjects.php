<!doctype html>
<html lang="en">
		<link rel="stylesheet" href="../../assets/css/version1.css">
		<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

	<body>

		<?php
			include '../getConnection.php';

			//assign variables.
			$subject_code 		= 	$_POST['subject_code'];
			$subject_name 		= 	$_POST['subject_name'];
			$selected_teacher 	= 	$_POST['subject_coordinator'];

			//get the date in Australia and assign variable
			date_default_timezone_set('Australia/Melbourne');
			$date = date('Y-m-d', time());

			if (isset($_POST["submit"])){
				if((!empty($subject_code)) && (!empty($subject_name)) && (!empty($selected_teacher)) ){
					//insert subject query, bind parameters and execute.
					$query_subject = $db->prepare("INSERT INTO subject VALUES(null, :bind_subjectCode, :bind_subjectName, :bind_selectedTeacher, :bind_date)");
					$query_subject->bindParam("bind_subjectCode", $subject_code);
					$query_subject->bindParam("bind_subjectName", $subject_name);
					$query_subject->bindParam("bind_selectedTeacher", $selected_teacher);
					$query_subject->bindParam("bind_date", $date);
					$query_subject->execute();

					//redirect back to all subjects.
					header("Location: all_Subjects.php");
				}
				else{
					echo "<div class='alert alert-error'>make sure you have all of your fields filled in and selected.</div>";

					header( "refresh:2; url=all_Subjects.php" );
				}
			}
		?>

	</body>
</html>