<?php
	include '../getConnection.php';

	$keyword = $_POST['keywordValue'];

	if(empty($_POST['keywordValue'])){
		$keyword = null;
	}

	$result = $db -> prepare("SELECT * FROM users WHERE (fName LIKE '%$keyword%' OR lName LIKE '%$keyword%' OR username LIKE '%$keyword%') LIMIT 1");
	//$result->bindParam("bind_keyword", $keyword);
	$result->execute();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$firstName = $row['fName'];
		$lastName = $row['lName'];
		$username = $row['username'];

		echo "<form method='post' action='enrol.php'>";
			echo "<div class='hero-unit'>";
				echo "<div>Name: ".$row['fName']." ".$row['lName']."</div>";
				echo "<input type='hidden' name='firstName' value='".$firstName."' />";
				echo "<input type='hidden' name='firstName' value='".$lastName."' />";
				echo "<div>Username: ".$row['username']."</div>";
				echo "<input type='hidden' name='firstName' value='".$username."' />";
				echo "<a name='submit_enrol' type='button' class='btn btn-primary pull-right' onclick='enrol'>Enrol this student</a>";
			echo "</div>";
		echo "</form>";
	}
?>