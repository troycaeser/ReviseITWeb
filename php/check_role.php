<?php
	include 'getConnection.php';
	
	session_start();

	if (empty($_SESSION['Role'])) {
		session_destroy();
		exit(header("Location: ../access_denied_login.php"));
	}
	
	function checkRoleStudent($role){
		if($role == 4){
			exit(header("Location: ../access_denied_login.php"));
		}
	}
	
	function checkRoleTeacher($role){
		if($role == 3){
			exit(header("Location: ../access_denied_login.php"));
		}
	}
	
	function checkRoleCod($role){
		if($role == 2){
			exit(header("Location: ../access_denied_login.php"));
		}
	}
	
	function checkRoleAdmin($role){
		if($role == 1){
			exit(header("Location: ../access_denied_login.php"));
		}
	}
?>