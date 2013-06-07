<?php
	ob_start();
	include 'getConnection.php';
	
	session_start();

	//echo $_SESSION['UserID'];
	$role = $_SESSION['Role'];
	$lock = $_SESSION['Lock'];
	
	if($lock == 1){
		exit(header("Location: ../access_denied_login.php"));	
		ob_get_flush();
	}

	else{

		if($role == 1){
			exit(header("Location: admin/admin_Home.php"));
			ob_get_flush();
		}
		else if ($role == 2){
			exit(header("Location: teacher/teacher_Home.php"));
			ob_get_flush();
		}
		else if($role == 3){
			exit(header("Location: teacher/teacher_Home.php"));
			ob_get_flush();
		}
		else if($role == 4){
			exit(header("Location: student/studentHome.php"));
			ob_get_flush();
		}
	}

?>