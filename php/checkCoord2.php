<?php
//Checks to see if coord matches subject
									
$subjectid = $subject_ID;
									
$result2 = $db->prepare("SELECT UserID FROM subject WHERE subjectID=:subID");
$result2->bindParam("subID", $subjectid);
$result2->execute();
							
$row2 = $result2->fetch(PDO::FETCH_ASSOC);
									
$coordCorrect = false;
									
if($row2['UserID'] == $_SESSION['UserID'])
{
	$coordCorrect = true;
}
?>