<?php
	ob_start();
	include '../getConnection.php';
	require '../check_logged_in.php';
	$User_ID = $_GET['ID'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		include '../header_container.php';
	?>
</head>
<body>
	<?php
		include 'student_menu_bar.php';
	?>
	<br /><br />

<div class="container">

	<div class="page-header">
        <h1>Test results</h1>
    </div>

<?php
/* 
        VIEW.PHP
        Displays all data from 'subtopic' table
*/  
                
        // Display data in table
        //echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        //echo "<table border='1' cellpadding='10'>";
        //echo "<tr> <th>Subtopic Name</th> <th>Content</th> <th>Date Updated</th> <th></th> <th></th></tr>";

        // Loop through results of database query, displaying them in the table
        
        // Close table>
        //echo "</table>";
		
		$result = $db->prepare("SELECT * FROM users WHERE UserID = '".$User_ID."'");
		$result->execute(); 
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$username = $row['username'];
		$fName = $row['fName'];
		$lName = $row['lName'];
		
		
?>

<!--<p><a href="new.php">Add a new record</a></p>--->
<!--<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>-->

    
    <!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                    <div class='span3'><h4>Subject Name</h4></div>
                    <div class='span3'><h4>Topic Name</h4></div>
                    <div class='span3'><h4>Subtopic Name</h4></div>
                    <div class='span3'><h4>Test Result</h4></div>
				</div>
            
            
            <?php

						//$firstName = $row['fName'];
						//$lastName = $row['lName'];
						
						// Get results from the database
						//$result = $db->prepare("SELECT * FROM results WHERE UserID = '".$User_ID."'");
						//$result->execute();    
						$Result2 = $db->prepare("SELECT * FROM results WHERE UserID = ".$User_ID);
						$Result2->execute(); 
						
						while($row2 = $Result2->fetch(PDO::FETCH_ASSOC)){
							
							$Result = $row2['Result'];

							$Result3 = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID = ".$row2['TestID'].";");
							$Result3->execute(); 
							$row3 = $Result3->fetch(PDO::FETCH_ASSOC);
							
							$topicID = $row3['TopicID'];
							$subtopic = $row3['SubtopicName'];
							$subtopicID = $row3['SubtopicID'];								
							
							$Result4 = $db->prepare("SELECT * FROM topic WHERE TopicID = ".$topicID);
							$Result4->execute(); 
							$row4 = $Result4->fetch(PDO::FETCH_ASSOC);
							$topic = $row4['TopicName'];
							$subjectID = $row4['SubjectID'];
							
							$Result5 = $db->prepare("SELECT * FROM subject WHERE SubjectID = ".$subjectID);
							$Result5->execute(); 
							$row5 = $Result5->fetch(PDO::FETCH_ASSOC);	
							$subject = $row5['SubjectName'];	
						
						//$user_query = $db->prepare("SELECT UserID, fName, lName FROM users WHERE UserID = :bind_userID");
						//$user_query->bindParam("bind_userID", $User_ID);
						//$user_query->execute();   
		
						//echo contents in divs
						echo "<div class='well'>";
							//echo "<a href='../contents/content.php?ID=".$row['UserID']."'>";
								echo "<div class='row-fluid'>";
									echo "<div class='span3'>".$subject."</div>";
									echo "<div class='span3'>".$topic."</div>";
									echo "<div class='span3'>".$subtopic."</div>";
									echo "<div class='span3'>".$Result."</div>";
								echo "</div>";
							echo "</a>";
						echo "</div>";
						echo "</br>";
						}	

			?>
            </div>
        </div>
    </div>
    <!-- Footer -->
		<?php
			include '../footer.php';
		?>                       
</body>
</html> 