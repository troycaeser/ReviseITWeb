<?php
	include 'init.php';

	function display_Welcome(){
		$result = mysql_query("SELECT CONCAT(fName,' ', lName) FROM users WHERE UserID = '".$_SESSION['UserID']."'") or die(mysql_error());

		$welcome_name = mysql_result($result, 0);
		return $welcome_name;
	}

	echo "<div class='welcome'>";
		echo "<h5> Welcome, ".display_Welcome()."</h5>";
	echo "</div>";
?>
