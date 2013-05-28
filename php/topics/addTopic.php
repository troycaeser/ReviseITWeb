<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstro.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

<?php
	ob_start();

	include '../getConnection.php';
	
	if(isset($_POST['Submit']))
	{
		try
		{
			$topicName = $_POST["strtopicName"];
			
			if(!empty($topicName))
			{
				if(!preg_match("/[A-Za-z]/", $topicName))	
				{
					echo "<div class='alert alert-error' align='center'>Topic name must be alphabetic</div>";
				}
				else
				{
					//This variable is used to obtain the SubjectID from the subject code
					$subjectCode = $_POST["subject_code"];
					
					date_default_timezone_set('Australia/Melbourne');
					$date = date('Y-m-d', time());
					
					$subIDsql = "SELECT SubjectCode FROM subject WHERE SubjectID = :subject_id";
					$sql = $db->prepare($subIDsql);
					$sql->bindParam("subject_id", $subjectCode);
					$sql->execute();
					
					$row = $sql->fetchColumn();
				
					//This sql query is used to insert the respective variable into the topic table
					$resultSQL = $db->prepare("INSERT INTO topic VALUES(null, :bind_TopicName, :bind_SubID, :bind_SubCode ,  0, :bind_date)");
					$resultSQL->bindParam("bind_TopicName", $topicName);
					$resultSQL->bindParam("bind_SubID", $subjectCode);
					$resultSQL->bindParam("bind_SubCode", $row);
					$resultSQL->bindParam("bind_date", $date);
					$resultSQL->execute();
					
					exit(header("location: viewTopic.php?ID=".$subjectCode));	
					ob_get_flush();
				}
			}
			else
			{
				echo "<div class='alert alert-error' align='center'>Topic name must not be empty & Subject code must be selected</div>";
				echo "<meta http-equiv='refresh' content='1;url=newTopic.php' />";
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
?>
</body>
</html>