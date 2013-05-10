<?php

	include '../getConnection.php';

	$stuff = $_GET['var_PHP_data'];

	echo $stuff;

	//$statement = $db->prepare("UPDATE subtopic SET Content = :bind_content");
	//$statement->bindParam("");
	
?>