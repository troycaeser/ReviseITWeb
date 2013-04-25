<?php
	
	include 'getConnection.php';

	$statement = $db->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
	$statement->bindParam("user", $username);
	$statement->bindParam("pass", $password);
	$statement->execute();
	
	if ('locked' == 1]) {
		session_destroy();
		header("Location: ../access_denied_login.php");
	}
?>


<?php
  include '../getConnection.php';
  require '../check_logged_in.php';
?>

<?php
		/*$current_user_query = $db->prepare("SELECT UserID FROM users WHERE userName= 'username'");
		$current_user_query->execute();
		$current_user = $current_user_query->fetch(PDO::FETCH_ASSOC);*/
		$username = $_GET['ID'];
		
		if ('locked' == 1]) {
		session_destroy();
		header("Location: ../access_denied_login.php");
	}
		
		header("Location: all_Accounts.php");
?>