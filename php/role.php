<?php

	include 'getConnection.php';

	//this function returns role from username
	function user_type_from_username($username){
		//$query = mysql_query("SELECT `role` FROM `users` WHERE `username` = '$username'");
		//return mysql_result($query, 0, 'role');

		//$db = dbConnect();

		$statement = $db->prepare("SELECT `role` FROM `users` WHERE `username` = ':userName'");
		$statement->bindParam('userName', $username);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	function user_type_from_userid($userId){
		//$query = mysql_query("SELECT `role` FROM `users` WHERE `UserID` = '$username'");
		//return mysql_result($query, 0, 'role');

		$statement = $db->prepare("SELECT `role` FROM `users` WHERE `UserID` = ':userId'");
		$statement->bindParam('userId', $userId);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
?>