<?php

	//echo get_subjectID();

	include '../getConnection.php';

	if (isset($_POST['chk_group'])) 
	{
		echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
		    $selected_chk = $_POST['chk_group'];
		    for ($i=0; $i<count($selected_chk); $i++) 
			{
		        echo "<div class='span4'>";
		        	//$global[$i] = $selected_chk[$i];
		        	//echo $global[$i];
		        	//echo "SUBJECT_ID = ".$selected_chk[$i];

		        	//select subject details according to their ids.
					$subject_query = $db->prepare("SELECT * FROM subject WHERE SubjectID = '".$selected_chk[$i]."'");
					$subject_query->execute();

					$user_query = $db->prepare("SELECT UserID, fName, lName FROM users WHERE role = 2 OR role = 3");
					$user_query->execute();

					$current_user_query = $db->prepare("SELECT UserID FROM subject WHERE SubjectID = '".$selected_chk[$i]."'");
					$current_user_query->execute();
					$current_user = $current_user_query->fetch(PDO::FETCH_ASSOC);
					//echo $current_user;

					while($row = $subject_query->fetch(PDO::FETCH_ASSOC))
					{
			        	echo "<fieldset>";
			        		echo "<input type='hidden' name='sub_ID".$selected_chk[$i]."' value='".$selected_chk[$i]."'>";
			        		echo "<div class='control-group'>";
			        			echo "<label class='control-label' for='subject_code'>Subject Code</label>";
			        			echo "<div class='controls'>";
			        				echo "<input type='text' name='subject_code".$i."' id='subject_code' value='".$row['SubjectCode']."' />";
			        			echo "</div>";
			        		echo "</div>";

			        		echo "<div class='control-group'>";
			        			echo "<label class='control-label' for='subject_name'>Subject Name</label>";
			        			echo "<div class='controls'>";
			        				echo "<input type='text' name='subject_name".$i."' id='subject_name' value='".$row['SubjectName']."' />";
			        			echo "</div>";
			        		echo "</div>";

			        		echo "<div class='control-group'>";
			        			echo "<label class='control-label' for='subject_coodinator'>Coordinator</label>";
			        			echo "<select name='subject_coordinator".$i."' id='subject_coordinator' multiple='multiple'>";
								    while($row = $user_query->fetch(PDO::FETCH_ASSOC))
									{
										echo("<option value='". $row['UserID'] ."' >". $row['fName'] ." ". $row['lName'] ."</option>");
									}
								echo "</select>";
			        		echo "</div>";
			        	echo "</fieldset>";
		        	}
					echo '<button type="submit" name="update_submit" class="btn">Update Subject Information</button>';
		        echo "</div>";
		    }
	    echo "</form>";
	}

	//not completely working at the moment, this query only edits up to 3 ids, and only works with ids up to 4....need to fix.
	if (isset($_POST["update_submit"]))
	{
    	for($i=0; $i<4; $i++)
		{
    		//update query
    		$query_update_string = $db->prepare("UPDATE subject SET SubjectID='".$_POST['sub_ID'.$i]."', SubjectCode='".$_POST['subject_code'.$i]."', SubjectName='".$_POST['subject_name'.$i]."', UserID='".$_POST['subject_coordinator'.$i]."' WHERE SubjectID='".$_POST['sub_ID'.$i]."'");
			$query_update_string->execute();
			//echo $teststring;
    	}
	}
?>