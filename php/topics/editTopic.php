<?php
	require '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];

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
	
	/*function renderForm($TopicID, $topName, $subCode, $error)
	{
		if($error !='')
		{
			echo '<div style="padding: 4px; border: 1px; solid red; color:red;">'.$error.'</div>';
		}
	}*/
	
	$result= $db->prepare("SELECT TopicName, SubjectCode FROM topic WHERE TopicID = '".$topic_ID."'");
	$result->execute();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		
		if($result)
		{
			$topName = $row['TopicName'];
			$subCode = $row['SubjectCode'];
				
			//renderForm($TopicID, $TopicName, $SubjectCode, $error, '');
		}
		else
		{
			echo "No Results";
		}
	}
	if(isset($_POST['submit']))
	{
		$topicName = $_POST['topicName'];	
		$subCode = $_POST['SubjCode'];
			
		$stmt = $db->prepare("UPDATE topic SET TopicName = '$topicName', SubjectCode = '$subCode' WHERE TopicID = '".$topic_ID."'");
		$stmt->execute();
		
		//renderForm($TopicID, $TopicName, $SubjectCode, $error, '');
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