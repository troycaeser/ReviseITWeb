<?php
	include '../getConnection.php';
	include '../check_logged_in.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
        include '../header_container.php';
    ?>
    <title>ReviseIT - New Topic</title>
</head>

<body>
<p align="right"><strong>Date: </strong><?php echo date("d/m/y") ?></p>
<?php
//SQL Script used to Insert the Topic Name and Subject Code typed in from the previous newTopic.html page
$topicName = $_POST["strtopicName"];
$subjectCode = $_POST["strsubjectCode"];

date_default_timezone_set('Australia/Melbourne');
$date = date('Y-m-d', time());

//SELECT SELECT topic.SubjectID from topic, subject WHERE subject.SubjectCode = topic.SubjectCode AND topic.SubjectCode = '$subjectCode';

if(isset($_POST['Submit']))
{
	try
	{
		if(!empty($topicName) && !empty($subjectCode))
		{
			//This sql select query used to combine the SubjectID from the Subject Table to the Topic table	
			$result = $db->prepare("SELECT topic.SubjectID from topic, subject WHERE subject.SubjectCode = topic.SubjectCode AND topic.SubjectCode = :subjCode");
			$result->bindParam("subjCode", $subjectCode);
			if($result->execute())
			{
				$comeback = $result->fetchColumn();
				echo $comeback;	
				
				//This sql query is used to insert the respective variable into the topic table
				$resultSQL = $db->prepare("INSERT INTO topic VALUES(NULL, ':topicName', :result , :subjCode, 0, :date");
				$resultSQL->bindParam("topicName", $topicName);
				$resultSQL->bindParam("result", $result);
				$resultSQL->bindParam("subjCode", $subjectCode);
				$resultSQL->bindParam("date", $date);
				$resultSQL->execute();		
				
				while($row = $resultSQL->fetch(PDO::FETCH_ASSOC))
				{
					echo $row['TopicName'];
				}
			}
		}
		else
		{
			echo "Please enter Topic Name & Subject Code";
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