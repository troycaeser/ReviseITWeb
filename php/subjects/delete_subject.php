<?php

	include '../getConnection.php';
	require '../check_logged_in.php';
	
	$subject_ID = $_GET['ID'];
		
	$subjectID = $_GET['DELETEID'];
	try
	{
		// Delete the entry
		$result = $db->prepare("DELETE FROM subject WHERE SubjectID = :bind_SubjectID");
		$result->bindParam("bind_SubjectID", $subjectID);
		$result->execute();

	 	header("Location: all_subjects.php");
	}
	catch(PDOExcepiton $e)
	{
		echo $e->getMessage();
	}
?>