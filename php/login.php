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
					$query = $db->prepare("SELECT `UserID` FROM `users` WHERE `username` =:userName ");
					$query->bindParam('userName', $username);
					$query->execute();
					$id = $query->fetchColumn();
					$_SESSION['UserID'] = $id;
					$_SESSION['Role'] = $role;
					$_SESSION['Lock'] = $lock;
					
					//get locked status from username
	 			    $query = $db->prepare("SELECT `locked` FROM `users` WHERE `username` = :userName");
					$query->bindParam('userName', $username);
					$query->execute();
					$role = $query->fetchColumn();

					if ($row['locked'] == "1"){
	
						session_destroy();
						header("Location: access_denied_login.php");	
					}
					

					header("Location: home_page_director.php");


					

				}
				else 
				{
					if(isset($_SESSION['loginCount']))
					{
						$_SESSION['loginCount']++;
						if($_SESSION['loginCount'] > 3)
						{
							echo "<script type='text/javascript'>alert('Your account has been locked.\\nPlease contact administrator')</script>";
							
							$statement = $db->prepare("UPDATE users SET locked = 1 WHERE username=:user OR password=:pass");
							$statement->bindParam("user", $username);
							$statement->bindParam("pass", $password);
							$statement->execute();
							$_SESSION['loginCount'] = 0;
							exit;
						}
						else
						{
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
				echo "please enter username and password";

			}
	}
	catch(PDOException $e)
	{
		echo "The system is experiencing some problems\n.We will try and get things running as soon as possible";
	}
?>

