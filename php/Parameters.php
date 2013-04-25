<?php

	function provideAccess($role){
		if ($role == 1) header("Location: admin/admin_Home.php");
		if ($role == 2) header("Location: teacher/teacher_Home.php");
		if ($role == 3) header("Location: teacher/teacher_Home.php");
		if ($role == 4) header("Location: student/studentHome.php");
		if ($lock == 1) header("Location: ../access_denied_login.php");	
		return false;
	}

?>