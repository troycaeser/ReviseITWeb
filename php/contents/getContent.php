<?php
//not in use
require_once '../getConnection.php';

$subtopic_ID = $_GET['ID'];
echo displayContent($subtopic_ID);


function displayContent($id)
{	
		//opening the first section of the row-fluid. (span 8) *Creates heading thing for table
		echo "<div class='span8'>";
			echo"<div class='row-fluid'>";
				echo "<div class='span2'><h4>Subtopic</h4></div>";
				echo "<div class='span5'><h4>Content</h4></div>";
				echo "<div class='span2'><h4>Downloads</h4></div>";
				echo "<div class='span2'><h4>Date</h4></div>";
			echo "</div>";

			//display results in a row-fluid/spans while looping. *Fills table over and over if records are available
			//
					
			try{			
				$result = $db->prepare("SELECT * FROM subtopic WHERE TopicID ='".$id."'") ;
        		$result->execute();   
				
				while($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					echo "<div class='row-fluid'>";
						echo "<div class='span2'>".$row['SubtopicID']."</div>";
						echo "<div class='span6'>".$row['Content']."</div>";
						echo "<div class='span2'>".$row['Downloads']."</div>";
						echo "<div class='span2'>".$row['DateUpdated']."</div>";
					echo "</div>";
					echo "<br />"; //Spaces them a little bit more apart as they are too close otherwise
				}
				echo "</div>";
			}
	catch(PDOException $e)
	{
		echo "Not working";
	}
}
?>