<?php
	include 'getConnection.php';

	//echo $_SESSION['UserID'];
	$role = $_SESSION['Role'];
	$lock = $_SESSION['Lock'];
	
	if($lock == 1){
		header("Location: ../access_denied_login.php");	
	}

	else{

		if($role == 1){
			header("Location: admin/admin_Home.php");
		}
		else if ($role == 2){
			header("Location: teacher/teacher_Home.php");
		}
		else if($role == 3){
			header("Location: teacher/teacher_Home.php");
		}
		else if($role == 4){
			header("Location: student/studentHome.php");
		}
	}

?>