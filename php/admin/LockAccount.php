<?php
  include '../getConnection.php';
  require '../check_logged_in.php';
?>

<?php
		/*$current_user_query = $db->prepare("SELECT UserID FROM users WHERE userName= 'username'");
		$current_user_query->execute();
		$current_user = $current_user_query->fetch(PDO::FETCH_ASSOC);*/
		$username = $_GET['ID'];
		
		$query_update_string = $db->prepare("UPDATE users SET locked = 1 WHERE username=:bind_username");
		$query_update_string->bindParam('bind_username', $username);
		$query_update_string->execute();
		
		header("Location: all_Accounts.php");
?>