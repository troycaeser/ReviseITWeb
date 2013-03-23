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
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
<title>View Subtopics</title>
</head>

<body>
<h1>Subtopic List</h1>
<?php
	$query = "Select * FROM subtopic WHERE TopicID = '".$path_parts['filename']."'";
	
	$SQL = mysql_query($query)
		or die("Problem loading query ".mysql_error());
	
	echo '<table border="1">';
	echo '<th>Subtopic Name</th><th>Content</th><th>Downloads</th><th>Date Updated</th>';
	while($row = mysql_fetch_array($SQL))
	{
		echo '<tr>';
		echo '<td>'.$row['SubtopicName'].'</td>';
		echo '<td>'.$row['Content'].'</td>';
		echo '<td>'.$row['Downloads'].'</td>';
		echo '<td>'.$row['DateUpdated'].'</td>';
		echo '</tr>';
	}
	echo '</table>';
?>
</body>
</html>