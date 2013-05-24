<?php

  	include '../getConnection.php';
	require '../check_logged_in.php';


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Record</title>
</head>

<body>
<?php
	/* 
	 DELETE.PHP
	 Deletes a specific entry from the 'user' table
	*/
	
	$UserID = $_GET['ID'];
	
	try{
		
			$query = "UPDATE subject SET UserID='' WHERE UserID =:bind_UserID";
			$stmt = $db->prepare($query);
			$stmt->bindParam("bind_UserID", $UserID);
			
			$stmt->execute();

			
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}

	try{
		
			$query = "DELETE FROM usersubject WHERE UserID =:bind_UserID";
			$stmt = $db->prepare($query);
			$stmt->bindParam("bind_UserID", $UserID);
			
			$stmt->execute();
			
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}

	try{
		
			$query = "DELETE FROM users WHERE UserID=:bind_UserID";
			$stmt = $db->prepare($query);
			$stmt->bindParam("bind_UserID", $UserID);
			
			$stmt->execute();
			echo "<div>Record was deleted.</div>";
			
			$fName = "";
		    $lName = "";
		    $userName = "";
		    $password = "";
			
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
		
		
		$db = NULL;		
		header("Location: all_Accounts.php");

?>
</body>
</html>