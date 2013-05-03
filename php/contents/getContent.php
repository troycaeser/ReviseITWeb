<?php

include '../getConnection.php';


echo displayContent($subtopic_ID);


function displayContent($id)
{
	//Execute a query to get all content from Subtopic
	$result = mysql_query("SELECT * FROM subtopic WHERE SubtopicID='".$id."'") or die(mysql_error());
	
	//opening the first section of the row-fluid. (span 8) *Creates heading thing for table
		echo "<div class='span8'>";
			echo"<div class='row-fluid'>";
				echo "<div class='span2'><h4>Subtopic</h4></div>";
				echo "<div class='span5'><h4>Content</h4></div>";
				echo "<div class='span2'><h4>Downloads</h4></div>";
				echo "<div class='span2'><h4>Date</h4></div>";
			echo "</div>";

			//display results in a row-fluid/spans while looping. *Fills table over and over if records are available
			while($row = mysql_fetch_array($result))
			{
				echo "<div class='row-fluid'>";
					echo "<div class='span2'>".$row['SubtopicName']."</div>";
					echo "<div class='span6'>".$row['Content']."</div>";
					echo "<div class='span2'>".$row['Downloads']."</div>";
					echo "<div class='span2'>".$row['DateUpdated']."</div>";
				echo "</div>";
				echo "<br />"; //Spaces them a little bit more apart as they are too close otherwise
			}
		echo "</div>";
}
?>