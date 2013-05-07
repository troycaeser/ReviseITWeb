<?php
	include '../getConnection.php';

	//assign variables.
	$subject_code = $_POST['subject_code'];
	$subject_name = $_POST['subject_name'];
	$selected_teacher = $_POST['subject_coordinator'];

	//get the date in Australia and assign variable
	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());

	if (isset($_POST["submit"])){
		//insert subject query.
		$query_subject = $db->prepare("INSERT INTO subject VALUES(null,'".$subject_code."','".$subject_name."', '".$selected_teacher."', '".$date."')");
		$query_subject->execute();

		header("Location: all_Subjects.php");
	}
?>
