<?php

//variable session check program
//check_first.php
	 
	session_start();
	if(!session_is_registered(user_session)){
	  echo"You are not Login yet.
	  You are not allowed to access this page";
	  echo("<br><a href=user.form.php><<< Login >>></a>");
	    exit;
	}
?>