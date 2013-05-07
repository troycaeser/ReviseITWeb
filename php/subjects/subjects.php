<?php

	include '../getConnection.php';

	$userRole = $_SESSION['Role'];

	try
	{
		
		$role_query = $db->prepare("SELECT role FROM users WHERE UserID = :userId");
		$role_query->bindParam("userId", $userid);
		$role_query->execute();
		$role_result = $role_query->fetch(PDO::FETCH_ASSOC);

		if($userRole == 1)
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID");
			$result->execute();
		}
		else if($userRole == 2)
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID");
			$result->execute();
			
			$result2 = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID AND subject.UserID = :bind_id");
			$result2->bindParam("bind_id",$_SESSION['UserID']);
			$result2->execute();
		}
		else if($userRole == 3 || $userRole == 4)
		{
			$result = $db->prepare("SELECT * FROM subject, users WHERE subject.UserID = users.UserID AND subject.UserID = :bind_id");
			$result->bindParam("bind_id",$_SESSION['UserID']);
			$result->execute();
		}
		
		//If you're an admin, you'll be able to edit the subjects, and if you're a teacher or student then you can only view the subjects
		if($userRole == 1)
		{
			echo "<div class='span8 bootstro' data-bootstro-placement='bottom' data-bootstro-title='List of subjects' data-bootstro-content='You may click on one of these links to go to the topics page that is associated with the selected subject.'>";
				echo "<div class='row-fluid'>";
					echo "<div class='span4'><h4>Subject</h4></div>";
					echo "<div class='span2'><h4>Code</h4></div>";
					echo "<div class='span2'><h4>Date</h4></div>";
					echo "<div class='span2'><h4>Coordinator</h4></div>";
					echo "<div class='span2'>&nbsp</div>";
				echo "</div>";
	
				//echo "<form action='edit_subject.php' method='post'>";
					//display everything in a row-fluid/spans while looping the result.
					//pass SubjectID in the url for each individual link.
					while($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						$subjectID = $row['SubjectID'];
						$subjectName = $row['SubjectName'];
						$subjectCode = $row['SubjectCode'];
						$dateUpdated = $row['Dateupdated'];
						$firstName = $row['fName'];
						$lastName = $row['lName'];

						//select subject details according to their ids.
						$subject_query = $db->prepare("SELECT * FROM subject WHERE SubjectID = '".$subjectID."'");
						$subject_query->execute();

						$user_query = $db->prepare("SELECT UserID, fName, lName FROM users WHERE role = 2 OR role = 3");
						$user_query->execute();

						echo "<div class='row-fluid'>";
							//adds checklist for each item.
		
							//display subjects in a list style with anchor pointing to the subject's topics
							//echo "<a rel='popover' data-toggle='popover' href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
							echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
									echo "<div class='span4'>".$row['SubjectName']."</div>";
									echo "<div class='span2'>".$row['SubjectCode']."</div>";
									echo "<div class='span2'>".$row['Dateupdated']."</div>";
									echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
									//echo "<div class='span2'><a href='delete_subject.php?ID=".$row['SubjectID']."'>Delete</a></div>";
							echo "</a>";
							echo "<a rel='popover' data-content='<a class=".'btn'." name=".'edit_Subject'." data-toggle=".'collapse'." data-target=".'#editSub'.$subjectID.''.">Edit</a><a href=".'delete_subject.php?DELETEID='.$subjectID.''." class=".'btn'." name=".'delete_Subject'." value=".$subjectID.">Delete</a>' class='btn popups' data-toggle='popover'><i class='icon-arrow-right'></i></a>";

							/* The Editing Block */
							echo "<div id='editSub".$subjectID."' class='collapse div'>";
								echo "<div class='hero-unit'>";
									echo "<h4>Editing Subject: <em><u>".$subjectName."</u></em></h4>";

									echo "<form method='post' action='edit_subject.php?ID=".$row['SubjectID']."'>";
									echo "<fieldset>";
										echo "<div class='control-group'>";
						        			echo "<label class='control-label' for='subject_code'>Subject Code</label>";
						        			echo "<div class='controls'>";
						        				echo "<input type='text' name='subject_code".$subjectID."' id='subject_code' value='".$subjectCode."' />";
						        			echo "</div>";
						        		echo "</div>";

						        		echo "<div class='control-group'>";
						        			echo "<label class='control-label' for='subject_code'>Subject Name</label>";
						        			echo "<div class='controls'>";
						        				echo "<input type='text' name='subject_name".$subjectID."' id='subject_name' value='".$subjectName."' />";
						        			echo "</div>";
						        		echo "</div>";

						        		echo "<label class='control-label' for='subject_coodinator'>Coordinator</label>";
					        			echo "<select name='subject_coordinator".$subjectID."' id='subject_coordinator' multiple='multiple'>";
										    while($row = $user_query->fetch(PDO::FETCH_ASSOC))
											{
												echo("<option value='". $row['UserID'] ."' >". $row['fName'] ." ". $row['lName'] ."</option>");
											}
										echo "</select>";
									echo "</fieldset>";

						        		echo '<button type="submit" name="update_submit" class="btn">Update</button>';
									echo "</form>";
								echo "</div>";
							echo "</div>";
							/* The Editing Block */
						echo "</div>";
					}
					//echo '<button type="submit" name="edit_submit" class="btn">Edit Selected Items</button>';
				//echo "</form>";
			echo "</div>";
		}
		else if($userRole == 2)
		{		
			//ALL SUBJECTS
			echo "<div class='span8 bootstro' data-bootstro-placement='bottom' data-bootstro-title='List of subjects' data-bootstro-content='You may click on one of these links to go to the topics page that is associated with the selected subject.'>";
				echo "<div class='row-fluid'>";
					echo "<div class='span3'><h4>Subject</h4></div>";
					echo "<div class='span2'><h4>Code</h4></div>";
					echo "<div class='span2'><h4>Date</h4></div>";
					echo "<div class='span2'><h4>Coordinator</h4></div>";
				echo "</div>";
	
				echo "<form action='' method='post'>";
					//display everything in a row-fluid/spans while looping the result.
					//pass SubjectID in the url for each individual link.
					while($row = $result2->fetch(PDO::FETCH_ASSOC))
					{
						//display subjects in a list style with anchor pointing to the subject's topics
						echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
							echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
								echo "<div class='span3'>".$row['SubjectName']."</div>";
								echo "<div class='span2'>".$row['SubjectCode']."</div>";
								echo "<div class='span2'>".$row['Dateupdated']."</div>";
								echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
								echo "<div class='span2'><a href='delete_subject.php?ID=".$row['SubjectID']."'>Delete</a></div>";  
							echo "</div>";
						echo "</a>";
					}
				echo "</form>";
			echo "</div>";

			//Co-ordinator assigned subject
			echo "<div class='span8 bootstro' data-bootstro-placement='bottom' data-bootstro-title='List of subjects' data-bootstro-content='You may click on one of these links to go to the topics page that is associated with the selected subject.'>";
				echo "<div class='row-fluid'>";
					echo "<div class='span3'><h4>Subject</h4></div>";
					echo "<div class='span2'><h4>Code</h4></div>";
					echo "<div class='span2'><h4>Date</h4></div>";
					echo "<div class='span2'><h4>Coordinator</h4></div>";
					
				echo "</div>";
	
				echo "<form action=''>";
					//display everything in a row-fluid/spans while looping the result.
					//pass SubjectID in the url for each individual link.
					while($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						//display subjects in a list style with anchor pointing to the subject's topics
						echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
							echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
								echo "<div class='span3'>".$row['SubjectName']."</div>";
								echo "<div class='span2'>".$row['SubjectCode']."</div>";
								echo "<div class='span2'>".$row['Dateupdated']."</div>";
								echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>";
								echo "<div class='span2'><a href='delete_subject.php?ID=".$row['SubjectID']."'>Delete</a></div>";  
							echo "</div>";
						echo "</a>";
					}
				echo "</form>";
			echo "</div>";
		}
		else
		{
			echo "<div class='span8 bootstro' data-bootstro-placement='bottom' data-bootstro-title='List of subjects' data-bootstro-content='You may click on one of these links to go to the topics page that is associated with the selected subject.'>";
				echo "<div class='row-fluid'>";
					echo "<div class='span3'><h4>Subject</h4></div>";
					echo "<div class='span2'><h4>Code</h4></div>";
					echo "<div class='span2'><h4>Date</h4></div>";
					echo "<div class='span2'><h4>Coordinator</h4></div>";
				echo "</div>";
	
				echo "<form action='' method='post'>";
					//display everything in a row-fluid/spans while looping the result.
					//pass SubjectID in the url for each individual link.
					while($row = $result->fetch(PDO::FETCH_ASSOC))
					{
	
						//display subjects in a list style with anchor pointing to the subject's topics
						echo "<a href='../topics/viewTopic.php?ID=".$row['SubjectID']."'>";
							echo "<div name='subject_ID".$row['SubjectID']."' id='".$row['SubjectID']."' class='row-fluid'>";
								echo "<div class='span3'>".$row['SubjectName']."</div>";
								echo "<div class='span2'>".$row['SubjectCode']."</div>";
								echo "<div class='span2'>".$row['Dateupdated']."</div>";
								echo "<div class='span2'>".$row['fName']." ".$row['lName']."</div>"; 
							echo "</div>";
						echo "</a>";
					}
				echo "</form>";
			echo "</div>";
		}
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