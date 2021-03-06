<?php
//Checks to see if coord matches subject
include 'getConnection.php';

$result0 = $db->prepare("SELECT TopicID FROM subtopic WHERE SubtopicID=:id");
$result0->bindParam("id", $subtopic_ID);
$result0->execute();
$row0 = $result0->fetch(PDO::FETCH_ASSOC);
$topicID = $row0['TopicID'];
									
$result1 = $db->prepare("SELECT SubjectID FROM topic WHERE TopicID=:id");
$result1->bindParam("id", $topicID);
$result1->execute();
$row1 = $result1->fetch(PDO::FETCH_ASSOC);	
$subjectid = $row1['SubjectID'];
									
$result2 = $db->prepare("SELECT UserID FROM subject WHERE subjectID=:subID");
$result2->bindParam("subID", $subjectid);
$result2->execute();
							
$row2 = $result2->fetch(PDO::FETCH_ASSOC);
									
$coordCorrect = false;
echo "topic id = ".$topicID;
echo "<br />";
echo "subject id = ".$subjectid;
echo "<br />";
echo "userid from subject = ".$row2['UserID'];
echo "<br />";
echo "session user id = ".$_SESSION['UserID'];
									
if($row2['UserID'] == $_SESSION['UserID'])
{
	$coordCorrect = true;
}
?>