<?php
	include 'init.php';

	if(empty($_POST) === false){

		$username = $_POST['username'];
		$password = $_POST['password'];

		if(empty($username) == true || empty($password) == true){
			$errors[] = 'You need to enter a username and password';
		}
		else if(user_exists($username) === false){
			$errors[] = 'Incorrect username!';
		}
		else{
			$query = mysql_query("SELECT COUNT(`UserID`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
			echo mysql_result($query, 0);
			//$password = md5($password);
			
			$login = login($username, $password);
			if($login === false){
				$errors[] = 'username and password do not match.';
			}
			else{
				//set the user session as the user ID, it is unique. $login returns user ID.
				$_SESSION['UserID'] = $login;
				
				//gets the role of the username
				include 'role.php';
 			    $role = user_type_from_username($username);

				//direct user to home page (depending on the role.)
				include 'Parameters.php';
				provideAccess($role);
			}
		}
		//print_r($errors);

	}

	function user_exists($username){
		$query = mysql_query("SELECT COUNT(`UserID`) FROM `users` WHERE `username` = '$username'");
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	function user_id_from_username($username){
		$query = mysql_query("SELECT `UserID` FROM `users` WHERE `username` = '$username'");
		return mysql_result($query, 0, 'UserID');
	}

	function login($username, $password){
		$user_id = user_id_from_username($username);

		$query = mysql_query("SELECT COUNT(`UserID`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
		return (mysql_result($query, 0) == 1) ? $user_id : false;
	}

?>
