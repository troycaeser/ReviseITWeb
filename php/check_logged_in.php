<?php
	ob_start();
	session_start();
	include 'getConnection.php';
	

	if (empty($_SESSION['UserID'])) {
		session_destroy();
		exit(header("Location: ../access_denied_login.php"));
		ob_get_flush();
	}
?>