<?php
//Checks to see if coord matches subject
include 'getConnection.php';

$result1 = $db->prepare("SELECT SubjectID FROM topic WHERE topicID=:topID");
$result1->bindParam("topID", $topic_ID);
$result1->execute();
							
$row1 = $result1->fetch(PDO::FETCH_ASSOC);
									
$subjectid = $row1["SubjectID"];
									
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