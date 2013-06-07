<?php

function enterToken($token){
	try{ $db = getConnection();
		$sql = "SELECT tokenCode from token ORDER BY tokenDate DESC LIMIT 1;"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("tokenCode", $token);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			if ($row->tokenCode == $token) return true; 
			else return false;
	}
	catch (PDOException $e){
		echo "Could not verify token";
		return false;
	}
}

function createToken($token){
	try{ $db = getConnection();
		date_default_timezone_set('Australia/Melbourne');
		$datetime = date('Y/m/d H:i:s');
		$sql = "INSERT INTO token (tokenCode, tokenDate) VALUES ('".$token."', '".$datetime."');"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("tokenCode", $token);
			$stmt->bindParam("tokenDate", $datetime);
			$stmt->execute();
			return true;
	}
	catch (PDOException $e){
		echo "Could not create token: Error";
		return false;
	}
}

function createUser($username, $password, $fName, $lName, $role){
	try{ $db = getConnection();
		$sql = "SELECT * FROM users WHERE username = '".$username."';"; 
		$stmt=$db->prepare($sql);
		$stmt->bindParam("username", $username);
		$stmt->execute();
		if ($row=$stmt->fetch(PDO::FETCH_OBJ)) return "error";
		else {		
			$pass = md5($password);
			$sql = "INSERT INTO users (username, password, fName, lName, role, locked) VALUES ('".$username."', '".$pass."', '".$fName."', '".$lName."', '".$role."', '0');"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("username", $username);
			$stmt->bindParam("password", $pass);
			$stmt->bindParam("fName", $fName);
			$stmt->bindParam("lName", $lName);
			$stmt->bindParam("role", $role);
			$stmt->execute();
		$sql = "SELECT MAX(UserID) 'uid' FROM users"; 
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
			return $row->uid;
		}
	}
	catch (PDOException $e){
		echo "Could not Create Account";
		return false;
	}
}

function editUser($fName, $lName, $username, $role, $UserID){
	try{ $db = getConnection();		
			$sql = "SELECT role FROM users WHERE username = '".$username."';"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("username", $username);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			//$oldrole = $row->role;
			//if ($oldrole == '2') downgradeCoord($UserID);
						
			$sql = "UPDATE users SET fName = '".$fName."', lName = '".$lName."', username = '".$username."', role = '".$role."' WHERE UserID = '".$UserID."';"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("UserID", $UserID);
			$stmt->bindParam("username", $username);
			$stmt->bindParam("fName", $fName);
			$stmt->bindParam("lName", $lName);
			$stmt->bindParam("role", $role);
			$stmt->execute();
			return true;
	}
	catch (PDOException $e){
		echo "Could not Edit Account";
		return false;
	}
}

function getDetails($UserID){
	try{ $db = getConnection();		
			$sql = "SELECT fName, lName, username, role, locked FROM users WHERE UserID = '".$UserID."';"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("UserID", $UserID);
			$stmt->execute();
			return ($stmt->fetch(PDO::FETCH_OBJ)); 
	}
	catch (PDOException $e){
		echo "Could not Retrieve Account";
		return false;
	}
}

function getSubjects(){
	try{ $db = getConnection();		
			$sql = "SELECT SubjectID, SubjectCode, SubjectName FROM subject;"; 
			$stmt=$db->prepare($sql);
			$stmt->execute();
			return ($stmt); 
	}
	catch (PDOException $e){
		echo "Could not Retrieve Subjects";
		return false;
	}
}

function assignCoord($SubjectID, $UserID){
	try{ 
			$db = getConnection();		
			$sql = "UPDATE subject SET UserID = '".$UserID."' WHERE SubjectID = '".$SubjectID."';"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("UserID", $UserID);
			$stmt->bindParam("SubjectID", $SubjectID);
			$stmt->execute();
			$sql = "UPDATE users SET role = '2' WHERE UserID = '".$UserID."';"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("UserID", $UserID);
			$stmt->execute();
			return true; 
	}
	catch (PDOException $e){
		echo "Could not Assign Coordinator!";
		return false;
	}
}

function downgradeCoord($UserID){
	try{ 
			$db = getConnection();		
			$sql = "SELECT SubjectID FROM subject WHERE UserID = ".$UserID.";"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("UserID", $UserID);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			$SubjectID = $row->SubjectID;
			$sql = "UPDATE subject SET UserID = '0' WHERE SubjectID = ".$SubjectID.";"; 
			$stmt=$db->prepare($sql);
			$stmt->bindParam("SubjectID", $SubjectID);
			$stmt->execute();
			return true; 
	}
	catch (PDOException $e){
		echo "Could not Downgrade Account";
		return false;
	}
}

// function getConnection(){
// 	try{
// 				$config['db'] = array(
//     'host'          =>'localhost',
//     'username'      =>'root',
//     'password'      =>'root',
//     'dbname'        =>'reviseit'
// );


// $db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// return $db;
// 	} catch(PDOException $e){
// 		echo"Database Connection Error!";
// 	}
// }

function getConnection(){
	try{
				$config['db'] = array(
    'host'          =>'reviseithg.db.11048397.hostedresource.com',
    'username'      =>'reviseithg',
    'password'      =>'ReviseIT!2013',
    'dbname'        =>'reviseithg'
);


// $db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// return $db;
// 	} catch(PDOException $e){
// 		echo"Database Connection Error!";
// 	}
// }
?>