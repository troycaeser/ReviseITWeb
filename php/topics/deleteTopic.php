<?php
	require('../init.php');

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
		
		$query = 'UPDATE topic SET deletionStatus = 1 WHERE TopicID="'.$topic_ID.'"';
		
		$SQL = mysql_query($query)
			or die("Problem executing query ".mysql_error());
	?>
    
    <script type="text/javascript">
		alert("Topic has been marked for deletion");
		
		var delete_IT = confirm("do you wish to view Topics?");
		
		if(delete_IT)
		{
			<?php
				$id=$row['TopicID'];
					
				echo "window.location.href = 'viewTopic.php?ID=".$topic_ID."'";
			?>
		}
		
		
	</script>
	
	<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
	<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>