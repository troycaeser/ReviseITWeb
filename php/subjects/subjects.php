<?php

	include '../getConnection.php';

	$userid = $_SESSION['UserID'];

	try
	{
		$role_query = $db->prepare("SELECT role FROM users WHERE UserID = :userId");
		$role_query->bindParam("userId", $userid);
		$role_query->execute();
		$role_result = $role_query->fetch(PDO::FETCH_ASSOC);

		if($role_result['role'] == 1)
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID");
			$result->execute();
		}
		else
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID AND users.UserID = ".$role_result['role']);
			$result->execute();
		}
		
		if($role_result['role'] == 2 || $role_result['role'] == 3 || $role_result['role'] == 4)
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID AND users.UserID = ".$role_result['role']);
			$result->execute();
			
			echo "<div class='span8'>";
				echo"<div class='row-fluid'>";
					echo "<div class='span1'></div>";
					echo "<div class='span5'><h4>Subject</h4></div>";
					echo "<div class='span2'><h4>Code</h4></div>";
					echo "<div class='span2'><h4>Date</h4></div>";
					echo "<div class='span2'><h4>Coordinator</h4></div>";
				echo "</div>";
	
				echo "<form action='' method=''>";
					//display everything in a row-fluid/spans while looping the result.
					//pass SubjectID in the url for each individual link.
					while($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						//adds checklist for each item.
						echo "<div class='span1'>";
							echo "<label class='checkbox'>";
								echo "<input name='chk_group[]' value='".$row['SubjectID']."' type='checkbox' />";
							echo "</label>";
						echo "</div>";
	
						//display subjects in a list style with anchor pointing to the subject's topics
						echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
							echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
								echo "<div class='span5'>".$row['SubjectName']."</div>";
								echo "<div class='span2'>".$row['SubjectCode']."</div>";
								echo "<div class='span2'>".$row['Dateupdated']."</div>";
								echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
							echo "</div>";
						echo "</a>";
					}
				echo "</form>";
			echo "</div>";
		}
		else
		{
			echo "<div class='span8'>";
			echo"<div class='row-fluid'>";
				echo "<div class='span1'></div>";
				echo "<div class='span5'><h4>Subject</h4></div>";
				echo "<div class='span2'><h4>Code</h4></div>";
				echo "<div class='span2'><h4>Date</h4></div>";
				echo "<div class='span2'><h4>Coordinator</h4></div>";
			echo "</div>";

			echo "<form action='edit_subject.php' method='post'>";
				//display everything in a row-fluid/spans while looping the result.
				//pass SubjectID in the url for each individual link.
				while($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					//adds checklist for each item.
					echo "<div class='span1'>";
						echo "<label class='checkbox'>";
							echo "<input name='chk_group[]' value='".$row['SubjectID']."' type='checkbox' />";
						echo "</label>";
					echo "</div>";

					//display subjects in a list style with anchor pointing to the subject's topics
					echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
						echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
							echo "<div class='span5'>".$row['SubjectName']."</div>";
							echo "<div class='span2'>".$row['SubjectCode']."</div>";
							echo "<div class='span2'>".$row['Dateupdated']."</div>";
							echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
						echo "</div>";
					echo "</a>";
				}
				echo '<button type="submit" name="edit_submit" class="btn">Edit Selected Items</button>';
			echo "</form>";
		echo "</div>";
		}


		
		//echo '<pre>', print_r($result, true), '</pre>';
		//echo '<pre>', print_r($stuff, true), '</pre>';

	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	//echo display_All_Subjects();

	/*function display_All_Subjects(){

		try{


		//prepare from the table "subject"
		$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID");
		$result->execute();
		echo '<pre>', print_r($result, true), '</pre>';
	}*/

		//opening the first section of the row-fluid. (span 8)
		//these are the titles - first row.
		/*echo "<div class='span8'>";
			echo"<div class='row-fluid'>";
				echo "<div class='span1'></div>";
				echo "<div class='span5'><h4>Subject</h4></div>";
				echo "<div class='span2'><h4>Code</h4></div>";
				echo "<div class='span2'><h4>Date</h4></div>";
				echo "<div class='span2'><h4>Coordinator</h4></div>";
			echo "</div>";

			echo "<form action='edit_subject.php' method='post'>";
				//display everything in a row-fluid/spans while looping the result.
				//pass SubjectID in the url for each individual link.
				while($row = $result->fetchAll(PDO::FETCH_ASSOC)){
					//adds checklist for each item.
					echo "<div class='span1'>";
						echo "<label class='checkbox'>";
							echo "<input name='chk_group[]' value='".$row['SubjectID']."' type='checkbox' />";
						echo "</label>";
					echo "</div>";

					//display subjects in a list style with anchor pointing to the subject's topics
					echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
					echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
						echo "<div class='span5'>".$row['SubjectName']."</div>";
						echo "<div class='span2'>".$row['SubjectCode']."</div>";
						echo "<div class='span2'>".$row['Dateupdated']."</div>";
						echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
					echo "</div>";
					echo "</a>";

				}

				echo '<button type="submit" name="edit_submit" class="btn">Edit Selected Items</button>';
			echo "</form>";

		echo "</div>";*/

	//}
?>