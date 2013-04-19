<?php
	
	try{

		include 'getConnection.php';
		//$db = dbConnect();

			$username = $_POST['username'];
			$password = $_POST['password'];

			if(!empty($username) && !empty($password)){
				$statement = $db->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
				$statement->bindParam("user", $username);
				$statement->bindParam("pass", $password);
				$statement->execute();

				//if there's only 1 user, do the following code.
				if($statement->rowCount() == 1){

					//get role from username
	 			    $query = $db->prepare("SELECT `role` FROM `users` WHERE `username` = :userName");
					$query->bindParam('userName', $username);
					$query->execute();
					$role = $query->fetchColumn();
					//echo '<pre>', print_r($role, true), '</pre>';

					//get id from username and set sessiosn.
					$query = $db->prepare("SELECT `UserID` FROM `users` WHERE `username` =:userName ");
					$query->bindParam('userName', $username);
					$query->execute();
					$id = $query->fetchColumn();
					$_SESSION['UserID'] = $id;
					$_SESSION['Role'] = $role;
					//echo '<pre>', print_r($id, true), '</pre>';

					header("Location: home_page_director.php");

	 			    //echo '<pre>', print_r($role, true), '</pre>';

	 			    //direct user to home page (depending on the role.)
					//include 'Parameters.php';
					//provideAccess($role);
				}else{
					echo "incorrect username or password";
				}

			}else{
				echo "please enter username and password";
			}

		//login($username, $password);

	}catch(PDOException $e){
		echo $e->getMessage();
	}
	

	//$db = getConnection();

	/*if(empty($_POST) === false){

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
*/
?>
