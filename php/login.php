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

				}
				else
				{
					if(isset($_SESSION['login_attempt']))
					{
						if($_SESSION['login_attempt'] < 3)
						{
							$attempt = $_SESSION['login_attempt'] + 1;
							
							if($attempt = 3)
							{
								echo "<script type='text/javascript'>alert('Cannot log in')</script>";
							}
						}
						else
						{
							echo "<script type='text/javascript'>alert('No log')</script>";
						}
					}
					else
					{
						header("Location: index.php");
					}
				}
			}
			else
			{
				echo "please enter username and password";
			}

		//login($username, $password);

	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
?>

