<?php
	//session_start();
	//error_reporting(1);

	require_once 'getConnection.php';

	//$db = getConnection();

	try{
        $db = getConnection();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>