<?php
	include '../getConnection.php';

	$keyword = $_POST['keywordValue'];

	if(empty($_POST['keywordValue'])){
		$keyword = null;
	}

	//select all user information whenever searched
	$result = $db -> prepare("SELECT * FROM users WHERE (fName LIKE '%$keyword%' OR lName LIKE '%$keyword%' OR username LIKE '%$keyword%') AND role = 4 LIMIT 1");
	//$result->bindParam("bind_keyword", $keyword);
	$result->execute();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$firstName = $row['fName'];
		$lastName = $row['lName'];
		$username = $row['username'];

		//select all subject information where the teacher is currently coordinating.
		$subject_query = $db->prepare("SELECT * FROM subject WHERE UserID = :bind_userID");
		$subject_query->bindParam("bind_userID", $_POST['userID']);
		$subject_query->execute();

		echo "<form method='post' action='enrol.php'>";
			echo "<div class='hero-unit'>";
				echo "<div>Name: ".$row['fName']." ".$row['lName']."</div>";
				echo "<input type='hidden' name='firstName' value='".$firstName."' />";
				echo "<input type='hidden' name='lastName' value='".$lastName."' />";
				echo "<div>Username: ".$row['username']."</div>";
				echo "<input type='hidden' name='userName' value='".$username."' />";
				echo "<label class='control-label' for='subject_coodinator'>Subject</label>";
    			echo "<select name='subject' id='subject' multiple='multiple'>";
				    while($row = $subject_query->fetch(PDO::FETCH_ASSOC))
					{
						echo("<option value='". $row['SubjectID'] ."' >". $row['SubjectCode'] . " - " .$row['SubjectName'] ."</option>");
					}
				echo "</select>";
				echo "<input   name='submit_enrol' type='submit' class='btn btn-primary pull-right' value='Enrol this student' />";
			echo "</div>";
		echo "</form>";
	}
?>