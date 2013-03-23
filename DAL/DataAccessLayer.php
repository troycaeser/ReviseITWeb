<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

function connectDB() {
	try{
		$hostname = 'localhost';
		$username = 'root';
		$password = 'root';
		$dbname = 'reviseit';
		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		return $dbh;
	}
	catch (PDOException $e){
		if($dbh != null) $dbh = null;
		die("Could not connect to database: - ".$e->getMessage());
	}
}

function enterToken($token){
	try{
		$dbh = connectDB();
		$sql = "SELECT tokenCode from token ORDER BY tokenDate DESC LIMIT 1;"; 
			$stmt=$dbh->prepare($sql);
			$stmt->bindParam("tokenCode", $token);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			$dbh = null;
			if ($row->tokenCode == $token) return true; 
			else return false;
	}
	catch (PDOException $e){
		if($dbh != null) $dbh = null;
		echo("Could not verify token: Error: - ".$e->getMessage());
		return false;
	}
}

function createToken($token){
	try{
		$dbh = connectDB();
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y/m/d', time());
		$sql = "INSERT INTO token (tokenCode, tokenDate) VALUES ('".$token."', '".$date."');"; 
			$stmt=$dbh->prepare($sql);
			$stmt->bindParam("tokenCode", $token);
			$stmt->bindParam("tokenDate", $date);
			$stmt->execute();
			$dbh = null;
			echo("Success");
			return true;
	}
	catch (PDOException $e){
		if($dbh != null) $dbh = null;
		echo("Could not create token: Error: - ".$e->getMessage());
		return false;
	}
}

function createUser($username, $password, $fName, $lName, $role){
	try{
		$dbh = connectDB();
		$sql = "INSERT INTO users (username, password, fName, lName, role) VALUES ('".$username."', '".$password."', '".$fName."', '".$lName."', '".$role."');"; 
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("username", $username);
		$stmt->bindParam("password", $username);
		$stmt->bindParam("fName", $username);
		$stmt->bindParam("lName", $username);
		$stmt->bindParam("role", $role);
		$stmt->execute();
		$dbh = null;
		return true;
	}
	catch (PDOException $e){
		if($dbh != null) $dbh = null;
		echo("Could not create Account: Error: - ".$e->getMessage());
		return false;
	}
}
?>
</body>
</html>