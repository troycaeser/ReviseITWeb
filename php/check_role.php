<?php
	ob_start();
	include 'getConnection.php';
	
	session_start();

	if (empty($_SESSION['Role'])) {
		session_destroy();
		exit(header("Location: ../access_denied_login.php"));
		ob_get_flush();
	}
	
	function checkRoleStudent($role){
		if($role == 4){
			session_destroy();
			exit(header("Location: ../access_denied_login.php"));
			ob_get_flush();
		}
	}
	
	function checkRoleTeacher($role){
		if($role == 3){
			session_destroy();
			exit(header("Location: ../access_denied_login.php"));
			ob_get_flush();
		}
	}
	
	function checkRoleCod($role){
		if($role == 2){
			session_destroy();
			exit(header("Location: ../access_denied_login.php"));
			ob_get_flush();
		}
	}
	
	function checkRoleAdmin($role){
		if($role == 1){
			session_destroy();
			exit(header("Location: ../access_denied_login.php"));
			ob_get_flush();
		}
	}
?>