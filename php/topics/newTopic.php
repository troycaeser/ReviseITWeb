<?php
 	ob_start();
	include '../getConnection.php';
	include '../check_logged_in.php';
	
	$subject_ID = $_GET['ID'];
	
	include '../checkCoord2.php';
								
	if($coordCorrect != true)
	{
	exit(header('location: ../notCoord.php'));
	ob_get_flush();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

<body>
<p align="right"><strong>Date: </strong><?php echo date("d/m/y") ?></p>
<?php

	$query = $db->prepare("SELECT * FROM subject WHERE SubjectID = ".$subject_ID);
	$query->execute();

?>
<form action="addTopic.php" method="post">
<table border="1" align="center">
   	<input type="hidden" id="topicID" name="topID" />
    
    <tr>
        <td><label for="topicN">Topic Name:</label></td>
        <td><input type="text" id="topicName" name="strtopicName" /></td>
	</tr>
    
	<input type="hidden" id="SubjectID" name="subID" />
    
    <tr>
        <td><label class="control-label" for="subject_code">Subject Code:</label><td>
			<div class="controls">
				<?php
					//echo out the select table (this is for the user id.)
				    echo "<select name='subject_code' id='subject_code' multiple='multiple'>";
					    while($row = $query->fetch(PDO::FETCH_ASSOC))
						{
							echo("<option value ='".$row['SubjectID']."'>".$row['SubjectName']."</option>");
						}
					echo "</select>";
				?>
			</div>
    </tr>
    
    <tr>
    	<td><label for="subTopic">Submit Topic</label></td>
        <td><input type="submit" value="Submit" name="Submit"/> <input type="reset" value="Clear" /></td>
</table>
</form>

<?php
	include '../footer.php';
?>
</body>
</html>