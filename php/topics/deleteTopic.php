<?php
	ob_start();
	require '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];

	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());
	
	$result = $db->prepare('UPDATE topic SET deletionStatus = 1, dateupdated =:date WHERE TopicID="'.$topic_ID.'"');
	$result->bindParam("date", $date);
	$result->execute();
	
	$query = $db->prepare("SELECT SubjectID FROM topic WHERE TopicID = :top_ID");
	$query->bindParam("top_ID", $topic_ID);
	$query->execute();
	$stuff = $query->fetchColumn();

	exit(header('Location: viewTopic.php?ID='.$stuff));
	ob_get_flush();
?>