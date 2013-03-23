<?php
	//this function returns role from username
	function user_type_from_username($username){
		$query = mysql_query("SELECT `role` FROM `users` WHERE `username` = '$username'");
		return mysql_result($query, 0, 'role');
	}
?>