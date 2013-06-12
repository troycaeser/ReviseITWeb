<?php
	ob_start();
	require '../getConnection.php';
	require '../check_logged_in.php';
	
	$topic_ID = $_GET['ID'];
	
	include '../checkCoordtop.php';
								
	if($coordCorrect != true)
	{
	exit(header('location: ../notCoord.php'));
	ob_get_flush();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstro.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

<body>
<?php 	
	$result= $db->prepare("SELECT TopicName, SubjectCode FROM topic WHERE TopicID = '".$topic_ID."'");
	$result->execute();
	
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$topName = $row['TopicName'];
	$subCode = $row['SubjectCode'];
	
	if(isset($_POST['submit']))
	{
		try
		{
			date_default_timezone_set('Australia/Melbourne');
			$date = date('Y-m-d', time());
			
			$topicName = htmlentities($_POST['topicName']);	
			$subCode = htmlentities($_POST['SubjCode']);
			
			if(empty($topicName) && empty($subCode))
			{
				echo "<div class='alert alert-error' align='center'>Topic name and Subject code must not be empty</div>";
			}
			else
			{
				 
				if(!preg_match("/[A-Za-z]/", $topicName))	
				{
					echo "<div class='alert alert-error' align='center'>Topic name must be alphabetic</div>";
				}
				elseif(!preg_match("/[A-Za-z0-9]/", $subCode))
				{
					echo "<div class='alert alert-error' align='center'>Subject code must be alphanumeric</div>";
				}
				else
				{
						
					$stmt = $db->prepare("UPDATE topic SET TopicName = :topicName, SubjectCode = :subCode, dateupdated = :date WHERE TopicID = :top_ID");
					$stmt->bindParam("top_ID", $topic_ID);
					$stmt->bindParam("topicName", $topicName);
					$stmt->bindParam("subCode", $subCode);
					$stmt->bindParam("date", $date);
					$stmt->execute();
					 
					$query = $db->prepare("SELECT SubjectID FROM topic WHERE TopicID = :top_ID");
					$query->bindParam("top_ID", $topic_ID);
					$query->execute();
					$stuff = $query->fetchColumn();
					
					header("Location: viewTopic.php?ID=".$stuff);
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
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