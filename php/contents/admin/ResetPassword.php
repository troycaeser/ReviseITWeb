<?php
  	include '../getConnection.php';
    require '../check_logged_in.php';
?>

<?php
		/*$current_user_query = $db->prepare("SELECT UserID FROM users WHERE userName= 'username'");
		$current_user_query->execute();
		$current_user = $current_user_query->fetch(PDO::FETCH_ASSOC);*/
		$username = $_GET['ID'];
		//$password = $_GET['password'];
		
		$query_reset_string = $db->prepare("UPDATE users SET password = Tafe123 WHERE $username=:bind_username");
		$query_reset_string->bindParam('bind_username', $username);
		$query_reset_string->execute();
		
		echo "Password has been reset";
		
		header("Location: all_Accounts.php");
?>