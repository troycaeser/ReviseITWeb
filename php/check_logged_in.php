<?php

	include 'init.php';

	echo $_SESSION['loggedin'];

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo "yup";
	} else {
	    echo "You are not logged in, Access denied";
	    //header("Location: ../../index.php");
	}

?>