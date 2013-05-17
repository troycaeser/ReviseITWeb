<?php
try
{
	include 'getConnection.php'; 
	
	session_start();

	$username 	= 	$_POST['username'];
	$password 	= 	$_POST['password'];
	$mdPassword = 	md5($password);
			
	//get locked status from username
	$query = $db->prepare("SELECT `locked` FROM `users` WHERE `username` = :userName");
	$query->bindParam('userName', $username);
	$query->execute();
	$locked = $query->fetchColumn();
			
	if($locked == 0)
	{
		//If the username or the password is not empty, do the following code.
		if(!empty($username) && !empty($password))
		{
			$statement = $db->prepare("SELECT * FROM `users` WHERE `username` = :user AND `password` = :pass");
			$statement->bindParam("user", $username);
			$statement->bindParam("pass", $mdPassword);
			$statement->execute();
		
			//if there's only 1 user, do the following code.
			if($statement->rowCount() == 1)
			{
				//get role from username
				$query = $db->prepare("SELECT `role` FROM `users` WHERE `username` = :userName");
				$query->bindParam('userName', $username);
				$query->execute();
				$role = $query->fetchColumn();
		
				//get id from username and set session.
				$query = $db->prepare("SELECT `UserID` FROM `users` WHERE `username` =:userName ");
				$query->bindParam('userName', $username);
				$query->execute();
				$id = $query->fetchColumn();
		
				//get username from username and set session.
				$query = $db->prepare("SELECT `username` FROM `users` WHERE `username` =:userName ");
				$query->bindParam('userName', $username);
				$query->execute();
				$username = $query->fetchColumn();
				$_SESSION['UserID'] = $id;
				$_SESSION['username'] = $username;
				$_SESSION['Role'] = $role;
		
				header("Location: home_page_director.php");
		
			}
			else 
			{
				//Login counter to determine if a person has attempted to login 3 times unsuccessfully
				if(isset($_SESSION['loginCount']))
				{
					
					$sql = $db->prepare("SELECT `role` FROM `users` WHERE `username` = :userName");
					$sql->bindParam('userName', $username);
					$sql->execute();
					$role = $sql->fetchColumn();
						
					if($role != 1)
					{
						echo "username or password is incorrect";
						$_SESSION['loginCount']++;
						//If a person has been unable to login successfully 3 times
						if($_SESSION['loginCount'] > 3)
						{
							//This alert javascript box will display notifying the person that their account has been locked
							echo "Your account has been locked\\nPlease contact administrator";
							echo "<meta http-equiv='refresh' content='2;url=../index.php' />";
										
							//This SQL statement updates their locked status from 0 to 1, depending on whether they entered the correct username and incorrect password, or vice versa
							$statement = $db->prepare("UPDATE users SET locked = 1 WHERE username=:user OR password=:pass");
							$statement->bindParam("user", $username);
							$statement->bindParam("pass", $password);
							$statement->execute();
							$_SESSION['loginCount'] = 0;
							exit;
						}
						else
						{
							//Stores each login attempt as a session until their 3rd attempt
							$_SESSION['loginCount'] = $_SESSION['loginCount'] + 1;
						}
					}
				}
				else
				{
					$_SESSION['loginCount'] = 1;
				}
				header("Location: ../index.php");
			}
		}
		else
		{
			//Error message displays if the person has not entered a username and password
			echo "please enter username and password";
		}
	}	
	else
	{
		echo "<script type='text/javascript'>alert('You cannot log in, when your account has been locked.\\nPlease try again later')</script>";	
	}
}
catch(PDOException $e)
{
	//A message if the system is down
	?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/version1.css">
    <link rel="stylesheet" href="../assets/css/bootstro.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-responsive.css">
    
	<?php
	echo "<div class='alert alert-error' align='center'>The system is experiencing some problems.\nWe will try and get things running as soon as possible</div>";
}
?>