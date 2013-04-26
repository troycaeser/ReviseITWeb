<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/logins/', 'getLogins');
$app->post('/editUser/', 'editUser');
$app->get('/getUser/:user', 'getUser');

//Bill, enter the username, then for password if you don't know it, you can use 'masterpass' it will log the account in and you can then change the password! ~ Luke

function getUser($user)
{
	$sql = "SELECT * from users where username=:user";
	try{
		// First we need to get a connection object to the database server.
		$hostname = 'localhost';
		$username = 'root';
		$password = 'root';
		$dbname = 'cloud';
		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("user",$user);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$dbh=null;
		echo json_encode($row);
		}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}


function getLogins()
{
	$request = \Slim\Slim::getInstance()->request();
	$q = json_decode($request->getBody());
	
	$sql = "SELECT * from users where username=:user AND password=:pass";
	
	try{
			// First we need to get a connection object to the database server.
			$hostname = 'localhost';
			$username = 'root';
			$password = 'root';
			$dbname = 'cloud';
			$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
			$stmt=$dbh->prepare($sql);
			
			$stmt->bindParam("user",$q->user);
			$hash_user = md5($q->user);
			$pw = $q->pass."041bbb5b2cbe8c36d00e417bb3b2686f".$hash_user;
			$new = md5($pw);
			$stmt->bindParam("pass",$new);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			$dbh=null;
			
			if($row == null)
			{
				echo '{"AKEY":"false"}';
			}
			else
			{
				echo '{"AKEY":"99123"}';
			}
		}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function editUser()
{
	$request = \Slim\Slim::getInstance()->request();
	$q = json_decode($request->getBody());
	
	$sql = "UPDATE users SET givenname=:given, surname=:sur, mobile=:mob, email=:email, password=:pass WHERE username=:user";
	
	try{
			// First we need to get a connection object to the database server.
			$hostname = 'localhost';
			$username = 'root';
			$password = 'root';
			$dbname = 'cloud';
			$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
			$stmt=$dbh->prepare($sql);
			$stmt->bindParam("user",$q->user);
			$stmt->bindParam("given",$q->given);
			$stmt->bindParam("sur",$q->sur);
			$stmt->bindParam("mob",$q->mob);
			$stmt->bindParam("email",$q->email);
			$hashuser = md5($q->user);
			$pw = $q->pass.'041bbb5b2cbe8c36d00e417bb3b2686f'.$hashuser;
			$hashed = md5($pw);
			$stmt->bindParam("pass", $hashed);
			$stmt->execute();
			//$row=$stmt->fetch(PDO::FETCH_OBJ);
			$dbh=null;
		}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}











//dont worry about below
function getConnection() 
{ //wrong
	$unisvr = 0;
	if($unisvr == 0)
	{
		$dbhost="127.0.0.1";
		$dbUser="root";
		$dbpass="root";
		$dbName="slimtest";
	};
		
	$dbConnection = mysql_connect($dbhost, $dbUser, $dbpass)
		or die('<p></p>' . mysql_error());
	return $dbConnection;	
}

$app->run();

