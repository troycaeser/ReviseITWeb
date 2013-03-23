<?php
	include '../init.php'
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View of all Topics!</title>
</head>

<body>
<?php
$query = mysql_query("SELECT * FROM topic")
	or die("Problem Reading Database". mysql_error());
	echo '<table border="1">';
	echo '<th>Topic ID</th><th>Topic Name</th><th>Subject ID</th><th>Subject Code</th>';
	while($row = mysql_fetch_assoc($query))
	{
		echo '<tr>';
		echo '<td>'.$row['TopicID'].'</td>';
		echo '<td>'.$row['TopicName'].'</td>';
		echo '<td>'.$row['SubjectID'].'</td>';
		echo '<td>'.$row['SubjectCode'].'</td>';
		echo '</tr>';
		
	}
	echo '</table>';
	echo '<br />';
	echo '<a href="newtopic.html">Add New Topic</a>';
	echo '<br />';
	echo '<a href="viewSubject.html">View Subject</a>';
?>
</body>
</html>