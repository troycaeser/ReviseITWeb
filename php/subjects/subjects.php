<?php

	include '../init.php';

	echo display_All_Subjects();

	function display_All_Subjects(){

		//get result from the table "subject"
		$result = mysql_query("SELECT * FROM subject, users WHERE subject.UserID = users.UserID") or die(mysql_error());
		$subjectID;

		//opening the first section of the row-fluid. (span 8)
		//these are the titles - first row.
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
				while($row = mysql_fetch_array($result)){
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
?>