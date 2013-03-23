<?php

	include 'init.php';
	include 'role.php';

	if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != false) {

	} else {
		session_destroy();
		header("Location: ../access_denied_login.php");
	}

?>