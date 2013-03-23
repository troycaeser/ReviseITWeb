<?php
	require('../init.php');

	//get the current path
	$current_url = $_SERVER['PHP_SELF'];

	//process $current_url into bits using parthinfo();
	$path_parts = pathinfo($current_url);

	//$path_parts['filename'] echoes out the last part of the url.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View of all Topics</title>
</head>

<body>
<p align="right"><strong>Date: </strong><?php echo date("d/m/y") ?></p>
<?php
//SQL Script used to Insert the Topic Name and Subject Code typed in from the previous newTopic.html page
$topicName = $_POST["strtopicName"];
$subjectCode = $_POST["strsubjectCode"];

//SELECT SELECT topic.SubjectID from topic, subject WHERE subject.SubjectCode = topic.SubjectCode AND topic.SubjectCode = '$subjectCode';

if(isset($_POST['Submit']))
{
	//This sql select query used to combine the SubjectID from the Subject Table to the Topic table	
	$data = mysql_query("SELECT topic.SubjectID from topic, subject WHERE subject.SubjectCode = topic.SubjectCode AND topic.SubjectCode = '$subjectCode'");
	$realData = mysql_result($data, 0, 'topic.SubjectID');
	
	//This sql query is used to insert the respective variable into the topic table
	$SQL = "INSERT INTO topic VALUES(NULL, '".$topicName."', '".$realData."', '".$subjectCode."', 0)"
		or die(mysql_error());
		
	$callSQL = mysql_query($SQL);
	
	//SQL query used to select all the records from the topic table	
	$query = mysql_query($callSQL);
	
	$query2 = "SELECT * from topic";
	$queryCall = mysql_query($query2, $dbhost);
		
	//While loop used to 'echo' the records from the topic table.
	echo '<table border="1">';
	echo '<th>Topic ID</th><th>Topic Name</th><th>Subject ID</th><th>Subject Code</th>';
	while($row = mysql_fetch_array($queryCall))
	{
		$id=$row['TopicID'];
		echo '<tr>';
		echo '<td>'.$row['TopicID'].'</td>';
		echo '<td><a href="viewsubtopic.php?id=$id">'.$row['TopicName'].'</a></td>';
		echo '<td>'.$row['SubjectID'].'</td>';
		echo '<td>'.$row['SubjectCode'].'</td>';
		echo '</tr>';
	}	
}
	mysql_close($dbhost);
?>
</body>
</html>