<?php
	
	include 'getConnection.php';

	if (empty($_SESSION['UserID'])) {
		session_destroy();
		header("Location: ../access_denied_login.php");
	}
?>