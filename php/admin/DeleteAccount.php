<?php

	include '../init.php';
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

	$action = isset($_GET['action']) ? $_GET['action']: "";

	if($action=='delete')
	{
		try {
		
			$query = "DELETE FROM users WHERE ID = ?";
			$stmt = $db->prepare($query);
			$stmt->bindParam(1, $_GET['ID']);
			
			$result = $stmt->execute();
			echo "<div>Record was deleted.</div>";
			
			header("Location: all_Accounts.php");
			
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
    
	}
	 
	 //  http://www.codeofaninja.com/2012/02/pdo-crud-tutorial.html
?>
</body>
</html>