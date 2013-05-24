<?php
	include '../getConnection.php';
	include '../check_logged_in.php';

	$subtopic_ID = $_GET['ID'];
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Contents</title>
	</head>
	<body>
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>View Content of <?php  try{			
			$result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID =:id");
			$result->bindParam("id", $subtopic_ID);
			$result->execute();   
			
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				echo $row['SubtopicName'];
			}
		}
		catch(PDOException $e)
		{
			echo "error";
		} ?></h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
				<?php //Inserts tables from database with information
					//include'getContent.php';
					
					echo "<div class='span12'>";
						echo"<div class='row-fluid'>";
							echo "<div class='span12'><h4><u>Content</u></h4></div>";
					echo "</div>";
					
					try{			
							$result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID =:id");
							$result->bindParam("id", $subtopic_ID);
							$result->execute();   
							
							while($row = $result->fetch(PDO::FETCH_ASSOC))
							{
								echo "<div class='row-fluid'>";
								if($row['Content'] == null)
								{
									echo "<div class='span12'>NO CONTENT IN SUBTOPIC = ".$row['SubtopicName']."<br />Would you like to add some now? <a href='editCont.php?ID=".$subtopic_ID."'>Yes</a><br />";
								}
								else
								{
									echo "<div class='span12'>".$row['Content']."</div>";
								}
								echo "</div>";
								echo "<div class='row-fluid'>";
									echo "<div class='span2'>Downloads = ".$row['Downloads']."</div>";
									echo "<div class='span4'>Last Updated = ".$row['DateUpdated']."</div>";
									if($row['Content'] == null)
									{
										echo "<div class='span1'>".'<a href="editCont.php?ID='.$row['SubtopicID'].'">Add</a></div>';
									}
									else
									{
										echo "<div class='span1'>".'<a href="editCont.php?ID='.$row['SubtopicID'].'">Edit</a></div>';
									}
									echo "<div class='span1'>".'<a href="deleteContent.php?ID='.$row['SubtopicID'].'">Delete</a></div>';
								echo "</div>";
								echo "<br />"; //Spaces them a little bit more apart as they are too close otherwise
								if ($_SESSION['Role'] == "2") echo "<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='All the subjects' data-bootstro-content='Click on the link to edit the test questions for this subtopic.'>
		<h3>Edit Test For This Subtopic!</h3>
		<p>Edit Test Questions!</p>
		<a href='EditTestQuestions.php?ID=".$row['TestID']."'>Edit Test</a></div>";
								else echo "<div class='span1'>".'<a href="ViewTestQuestions.php?ID='.$row['SubtopicID'].'">Take Test</a></div>';
							}
							echo "</div><br /><br /><br /><br />";
							
						}
				catch(PDOException $e)
				{
					echo "Not working";
				}
				?>
                
			</div>
		</div>
		
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>