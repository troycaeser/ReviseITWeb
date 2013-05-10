<?php

	include '../getConnection.php';
	require '../check_logged_in.php';

	if(isset($_POST['update_submit'])){
		
		$subjectID 		= 	$_GET['ID'];
		$subjectName 	= 	$_POST['subject_name'.$_GET['ID']];
		$subjectCode 	= 	$_POST['subject_code'.$_GET['ID']];
		$selectedUser 	= 	$_POST['subject_coordinator'.$_GET['ID']];

		//get the date in Australia and assign variable
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y-m-d', time());

		$query_update_string = $db->prepare("UPDATE subject SET SubjectID = :bind_SubjectID, SubjectCode = :bind_SubjectCode, SubjectName = :bind_SubjectName, UserID = :bind_UserID, Dateupdated = :bind_Date WHERE SubjectID = :bind_SubjectID");
		$query_update_string->bindParam("bind_SubjectID", $subjectID);
		$query_update_string->bindParam("bind_SubjectCode", $subjectCode);
		$query_update_string->bindParam("bind_SubjectName", $subjectName);
		$query_update_string->bindParam("bind_UserID", $selectedUser);
		$query_update_string->bindParam("bind_Date", $date);
		$query_update_string->execute();

		header("Location: all_Subjects.php");

	}
?>