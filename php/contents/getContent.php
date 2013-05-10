<?php

echo displayContent();

function displayContent()
{
	connect();
	//Execute a query to get all content from Subtopic
	$result = mysql_query("SELECT * FROM subtopic") or die(mysql_error());
	
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

function connect()
{
	$hostname = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'reviseit';
    $connect_error = 'Sorry, We\'re experiencing connection problems.';

    //connecting to the databse using variables
	mysql_connect($hostname, $username, $password) or die ($connect_error);

	//selecting a database
	mysql_select_db($dbname) or die($connect_error);
}

/*<?php
require_once '../getConnection.php';

$subtopic_ID = $_GET['ID'];
echo displayContent($subtopic_ID);


function displayContent($id)
{
	$db = connect();
	echo "dasd".$db;
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
				$result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID=:subId");
				$result->bindParam("subId",$id);
				$result->execute();
				$row = $result->fetch(PDO::FETCH_OBJ);			
			
					echo "<div class='row-fluid'>";
						echo "<div class='span2'>".$row['SubtopicID']."</div>";
						echo "<div class='span6'>".$row['Content']."</div>";
						echo "<div class='span2'>".$row['Downloads']."</div>";
						echo "<div class='span2'>".$row['DateUpdated']."</div>";
					echo "</div>";
					echo "<br />"; //Spaces them a little bit more apart as they are too close otherwise

				echo "</div>";
			}
	catch(PDOException $e)
	{
		echo "Not working";
	}
}


?>*/?>