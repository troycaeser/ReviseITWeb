<?php
	ob_start();
	include '../getConnection.php';
	require '../check_logged_in.php';
	
	$subtopic_ID = $_GET['ID'];

	include '../checkCoord.php';
								
	if($coordCorrect != true)
	{
	exit(header('location: ../notCoord.php'));
	ob_get_flush();
	}

//--------------------------------------------------------------------------------------------
	/* 
	 DELETE.PHP
	 Deletes a specific entry from the 'user' table
	*/
	$Subtopic_ID = $_GET['ID'];
		
		try {
			//attempt to grab the topic id from the subtopic id.
			$statement = $db->prepare("SELECT TopicID FROM subtopic WHERE SubtopicID = :bind_subtopicID");
			$statement->bindParam("bind_subtopicID", $Subtopic_ID);
			$statement->execute();

			//assign variable with the select query from $statement
			$Topic_ID = $statement->fetchColumn();

			//the delete code
			$stmt = $db->prepare("DELETE FROM subtopic WHERE SubtopicID=:subtopic_ID");
			$stmt->bindParam(":subtopic_ID", $Subtopic_ID);
			$stmt->execute();

			//redirect to view using the newly assigned variable.
			exit(header("Location: view.php?ID=".$Topic_ID));
			ob_get_flush();
			
		}catch(PDOException $exception){ //to handle error
			echo "There was an error...";
		}
		
		
?>