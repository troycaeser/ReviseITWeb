<?php
	$hostname = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'reviseit';
    $connect_error = 'Sorry, We\'re experiencing connection problems.';

    //connecting to the databse using variables
	mysql_connect($hostname, $username, $password) or die ($connect_error);

	$con = mysqli_connect($hostname, $username, $password, $dbname);

	//selecting a database
	mysql_select_db($dbname) or die($connect_error);
?>