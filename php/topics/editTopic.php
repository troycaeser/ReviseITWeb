<?php
	require '../init.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];

	//$path_parts['filename'] echoes out the last part of the url.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		include '../header_container.php';
	?>
	<title>ReviseIT - Edit Topics</title>
</head>

<body>
<?php 
	
	function renderForm($TopicID, $topName, $subCode, $error)
	{
		if($error !='')
		{
			echo '<div style="padding: 4px; border: 1px; solid red; color:red;">'.$error.'</div>';
		}
	}
	
	
	$query = "SELECT TopicName, SubjectCode FROM topic WHERE TopicID = '".$topic_ID."'";
		
	$SQL = mysql_query($query)
		or die("Problem loading query ".mysql_error());
			
	$row = mysql_fetch_array($SQL);
			
	if($row)
	{
		$topName = $row['TopicName'];
		$subCode = $row['SubjectCode'];
			
		renderForm($TopicID, $TopicName, $SubjectCode, $error, '');
	}
	else
	{
		echo "No Results";
	}
	
	if(isset($_POST['submit']))
	{
		header("Location:../viewTopic.php/".$row['SubjectID']);
		$topicName = $_POST['topicName'];
		$subCode = $_POST['SubjCode'];
					
		$SQL = "UPDATE topic SET TopicName = '$topicName', SubjectCode = '$subCode' WHERE TopicID = '".$path_parts['filename']."'";
		
		$query = mysql_query($SQL)
			or die("Problem updating table ".mysql_error());
		
		renderForm($TopicID, $TopicName, $SubjectCode, $error, '');
	}
?>
<form method="post" action="">
<label for="topicName">Topic Name:</label>
<input type="text" name="topicName" value="<?php echo $topName; ?>"/>
<br/>
<br/>
<label for="subjCode">Subject Code:</label>
<input type="text" name="SubjCode" value="<?php echo $subCode; ?>"/>
<br/>
<br/>
<input type="submit" name="submit" value="Update Topic"/>
</form>
</body>
</html>