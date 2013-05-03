<?php

	include '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Record</title>
</head>

<body>

<?php
	
	/* 
	 DELETE.PHP
	 Deletes a specific entry from the 'subtopic' table
	*/

	/*
	// Get id value
	$SubtopicID = $_GET['id'];
	 
	 // Check if the 'id' variable is set in URL, and check that it is valid
	 if (isset($_GET['id']) && is_numeric($_GET['id']))
	 {
		 
		 // Delete the entry
		 $result = mysql_query("DELETE FROM subtopic WHERE SubtopicID=$SubtopicID")
		 or die(mysql_error()); 
		 
		 // Redirect back to the view page
		 header("Location: view.php");
	 }
	 else
	 // If id isn't set, or isn't valid, redirect back to the view page
	 {
	 	header("Location: view.php");
	 }
	*/

//--------------------------------------------------------------------------------------------
	/* 
	 DELETE.PHP
	 Deletes a specific entry from the 'user' table
	*/
	
	$SubtopicID = $_GET['ID'];
	
	if (isset($_POST['delete']))
    {
		
		try {
		
			$query = "DELETE FROM subtopic WHERE SubtopicID=:subtopic_ID";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":subtopic_ID", $SubtopicID);
			$stmt->execute();
			
			header("Location: view.php?ID=".$topic_ID."");
			
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}
?>
</body>
</html>


