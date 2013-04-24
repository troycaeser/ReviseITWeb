<?php
	try
	{
		include 'getConnection.php';

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

					//get id from username and set sessiosn.
					$query = $db->prepare("SELECT `username` FROM `users` WHERE `username` =:userName ");
					$query->bindParam('userName', $username);
					$query->execute();
					$id = $query->fetchColumn();
					$_SESSION['UserID'] = $id;
					$_SESSION['Role'] = $role;

					header("Location: home_page_director.php");

				}
				else
				{
					//Login counter to determine if a person has attempted to login 3 times unsuccessfully
					if(isset($_SESSION['loginCount']))
					{
						$_SESSION['loginCount']++;
						//If a person has been unable to login successfully 3 times
						if($_SESSION['loginCount'] > 3)
						{
							//This alert javascript box will display notifying the person that their account has been locked
							echo "<script type='text/javascript'>alert('Your account has been locked.\\nPlease contact administrator')</script>";
							
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
					else
					{
						$_SESSION['loginCount'] = 1;
					}
				}
			}
			else
			{
				//Error message displays if the person has not entered a username and password
				echo "please enter username and password";
			}
	}
	catch(PDOException $e)
	{
		//A message if the system is down
		echo "The system is experiencing some problems\n.We will try and get things running as soon as possible";
	}
?>

