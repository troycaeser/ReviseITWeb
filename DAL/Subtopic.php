<?php

function getDetails($subtopic_ID){
	try{ 	
			$db = getConnection();		
			$stmt = $db->prepare("SELECT SubtopicName, SubtopicBriefDescription, DateUpdated FROM subtopic WHERE SubtopicID = '".$subtopic_ID."';"); 
			$stmt->bindParam("SubtopicID", $subtopic_ID);
			$stmt->execute();
			return ($stmt->fetch(PDO::FETCH_OBJ)); 
	}
	catch (PDOException $e){
		echo "Could not retrieve subtopic details";
		return false;
	}
}

function getConnection(){
	try{
/*
		$config['db'] = array(
	    	'host'          =>'reviseithg.db.11048397.hostedresource.com',
	        'username'      =>'reviseithg',
	        'password'      =>'ReviseIT!2013',
	        'dbname'        =>'reviseithg'
		);
*/
		$config['db'] = array(
	    	'host'          =>'localhost',
	        'username'      =>'root',
	        'password'      =>'root',
	        'dbname'        =>'reviseit'
		);

		$db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	} catch(PDOException $e){
		echo"Database Connection Error!";
	}
}

?>