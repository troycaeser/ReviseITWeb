<?php
	include 'getConnection.php';

	function display_Welcome(){
		$result = $db->prepare("SELECT CONCAT(fName,' ', lName) FROM users WHERE UserID = :userid");
		$result->bindParam("userid", $_SESSION['UserID']);
		$result->execute();
		$welcome_name = $query->fetchColumn();
		echo $welcome_name;
		//return $welcome_name;
	}

	echo "<div class='welcome'>";
		echo "<h5> Welcome, ".display_Welcome()."</h5>";
	echo "</div>";
?>
