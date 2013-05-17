<?php
	require '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Topic Deletion</title>
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
</head>
<body>

	<?php
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y-m-d', time());
		
		$result = $db->prepare('UPDATE topic SET deletionStatus = 1, dateupdated =:date WHERE TopicID="'.$topic_ID.'"');
		$result->bindParam("date", $date);
		$result->execute();
		
		$query = $db->prepare("SELECT SubjectID FROM topic WHERE TopicID = :top_ID");
		$query->bindParam("top_ID", $topic_ID);
		$query->execute();
		$stuff = $query->fetchColumn();
	?>
    
    <script type="text/javascript">
	var delete_IT = confirm("Do you wish to view Topics?");
		
	if(delete_IT)
	{
		<?php
			echo "<script type='text/javascript'>alert('Topic has been marked for deletion')</script>";
			echo "window.location.href = 'viewTopic.php?ID=".$stuff."'";
		?>
	}
	</script>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>