<?php
	require '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-wysihtml5-0.0.2.css"></link>
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstro.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

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
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y-m-d', time());
	
		$topicName = htmlentities($_POST['topicName']);	
		$subCode = htmlentities($_POST['SubjCode']);
			
		$stmt = $db->prepare("UPDATE topic SET TopicName = :topicName, SubjectCode = :subCode, dateupdated = :date WHERE TopicID = '".$topic_ID."' ");
		$stmt->bindParam("topicName", $topicName);
		$stmt->bindParam("subCode", $subCode);
		$stmt->bindParam("date", $date);
		$stmt->execute();
		
		header("Location: viewTopic.php?ID=".$topic_ID);
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