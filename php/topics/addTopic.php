<?php
	include '../getConnection.php';
	

	//SQL Script used to Insert the Topic Name and Subject Code typed in from the previous newTopic.html page
	$topicName = $_POST["strtopicName"];
	
	//this is subject id
	$subjectCode = $_POST["subject_code"];
	
	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());
	
	//SELECT SELECT topic.SubjectID from topic, subject WHERE subject.SubjectCode = topic.SubjectCode AND topic.SubjectCode = '$subjectCode';
	$subIDsql = "SELECT SubjectCode FROM subject WHERE SubjectID = :subject_id";
	$sql = $db->prepare($subIDsql);
	$sql->bindParam("subject_id", $subjectCode);
	$sql->execute();
	
	
	if(isset($_POST['Submit']))
	{
		$row = $sql->fetchColumn();
		try
		{	
			//This sql query is used to insert the respective variable into the topic table
			$resultSQL = $db->prepare("INSERT INTO topic VALUES(null, :bind_TopicName, :bind_SubID, :bind_SubCode ,  0, :bind_date)");
			$resultSQL->bindParam("bind_TopicName", $topicName);
			$resultSQL->bindParam("bind_SubID", $subjectCode);
			$resultSQL->bindParam("bind_SubCode", $row);
			$resultSQL->bindParam("bind_date", $date);
			$resultSQL->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
?>
</body>
</html>