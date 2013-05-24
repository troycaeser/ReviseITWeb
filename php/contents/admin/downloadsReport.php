<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
<head>
<?php
	include '../header_container.php';
?>
<title>ReviseIT - Downloads</title>
</head>
<body>
<?php
	include 'admin_menu_bar.php';
?>
<br />
<br />
<div class="container">
    <div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Subjects" data-bootstro-content="Welcome to the subjects page!">
      <h1>Report - Downloads</h1>
    </div>
	<div class='row-fluid'> 
<!-- Displays All subjects etc -->
	<?php

	include '../getConnection.php';

	$userRole = $_SESSION['Role'];

	try
	{		
		$subj = $db->prepare("SELECT * FROM subject;");
		$subj->execute();
		$subjResult = $subj;
	}
	catch (PDOException $e){
		echo "Database Error";
	}

	echo "<div class='span12 bootstro' data-bootstro-placement='bottom' data-bootstro-title='List of downloads' data-bootstro-content='Displays Number of Downloads for Subtopic Content'>";
	echo "<div class='span5'><h4>Subject</h4></div>";
	echo "<div class='span3'><h4>Topic</h4></div>";
	echo "<div class='span3'><h4>Subtopic</h4></div>";
	echo "<div class='span1'><h4>Downloads</h4></div>";
	
	echo "<div class='row-fluid'>";
	//display everything in a row-fluid/spans while looping the result.
	//pass SubjectID in the url for each individual link.	
	while($row = $subjResult->fetch(PDO::FETCH_OBJ))
		{
			//display subjects in a list style with anchor pointing to the subject's topics

			//echo "<a href='../topics/viewTopic.php?ID=".$row->SubjectID."'>";
			echo "<div class='span5'>".$row->SubjectCode.": ".$row->SubjectName."</div>";
			//echo "</a>";

			try	{							
				$topc = $db->prepare("SELECT * FROM topic WHERE SubjectID = ".$row->SubjectID.";");
				$topc->bindParam("SubjectID", $row->SubjectID);
				$topc->execute();
				$topcResult = $topc;
				}
			catch (PDOException $e){
				echo "Database Error";
				}
			while($row1 = $topcResult->fetch(PDO::FETCH_OBJ))
				{
				//display topics in a list style with anchor pointing to the topics's subtopics
				//echo "<a href='../subtopics/view.php?ID=".$row1->TopicID."'>";
				echo "<div class='span3'>".$row1->TopicName."</div>";
				//echo "</a>";
				try {							
					$sbtp = $db->prepare("SELECT * FROM subtopic WHERE TopicID = ".$row1->TopicID.";");
					$sbtp->bindParam("TopicID", $row1->TopicID);
					$sbtp->execute();
					$sbtpResult = $sbtp;
					}
				catch (PDOException $e){
					echo "Database Error";
					}
				while($row2 = $sbtpResult->fetch(PDO::FETCH_OBJ))
					{
					//display subtopicss in a list style with anchor pointing to the subtopics
					//echo "<a href='../contents/content.php?ID=".$row2->SubtopicID."'>";
					echo "<div class='span3'>".$row2->SubtopicName."</div>";
					//echo "</a>";
					echo "<div class='span1'>".$row2->Downloads."</div>";																		
					echo "</div><div class='row-fluid'>";
					echo "<div class='span5'>&nbsp;</div>";
					echo "<div class='span3'>&nbsp;</div>";

					} // End Subtopics loop
				echo "</div><div class='row-fluid'>";
				echo "<div class='span5'>&nbsp;</div>";
				} // End Topics loop				
			echo "</div><div class='row-fluid'>";
			} // End Subjects loop
		echo "</div>";
		echo "</div>";
	?>
	</div>
</div>

<!-- Footer -->
<?php
	include '../footer.php';
?>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script> 
<script src="../../assets/js/bootstro.js"></script>
</body>
</html>