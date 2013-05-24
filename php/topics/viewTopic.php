<?php
	require'../getConnection.php';
	require '../check_logged_in.php';

	$subject_ID = $_GET['ID'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Topics</title>
	</head>

	<body>
			<?php
				include 'topics_menu_bar.php';
			?>

			<br /><br />

			<div class="container">

				<div class="page-header">
					<h1>List of Topics</h1>
				</div>
				
				<div class="row-fluid">
					<?php
					$userRole = $_SESSION['Role'];
					
					try
					{
						if($userRole != 1 && $userRole != 2)
						{
							//select topic accoding to subject id.
							$result = $db->prepare("SELECT * FROM topic WHERE SubjectID = '".$subject_ID."' AND deletionStatus = 0");
							$result->execute();
						
							echo "<div class='span8'>";
								echo"<div class='row-fluid'>";
									echo "<div class='span12'><h4>Topic Name</h4></div>";
								echo "</div>";
	
							while($row = $result->fetch(PDO::FETCH_ASSOC))
							{
								$id=$row['TopicID'];
								
								echo "<a href='../subtopics/view.php?ID=".$row['TopicID']."'>";	
										echo "<div class='span12'>".$row['TopicName']."</div>";
								echo "</a>";
	
							}
							echo "</div>";
						}
						else
						{
							//select topic accoding to subject id.
							$result = $db->prepare("SELECT * FROM topic WHERE SubjectID = '".$subject_ID."' AND deletionStatus = 0");
							$result->execute();
							$TopicResult = $result->rowCount();
							
							if($TopicResult >= 1)
							{
								echo "<div class='span8'>";
									echo"<div class='row-fluid'>";
										echo "<div class='span3'><h4>Topic Name</h4></div>";
										echo "<div class='span6'><h4>Edit Topic</h4></div>";
										echo "<div class='span3'><h4>Delete Topic</h4></div>";
									echo "</div>";
		
								while($row = $result->fetch(PDO::FETCH_ASSOC))
								{
									$id=$row['TopicID'];
									
									echo "<a href='../subtopics/view.php?ID=".$row['TopicID']."'>";	
											echo "<div class='span3'>".$row['TopicName']."</div>";
											echo "<div class='span6'><a href='editTopic.php?ID=".$row['TopicID']."'>Edit</a></div>";
											echo "<div class='span3'><a href='deleteTopic.php?ID=".$row['TopicID']."'>Delete</a></div>";
									echo "</a>";
		
								}
								echo "<br><a class='btn' href='newTopic.php'>Add New Topic</a></input>";
								echo "</div>";
							}
							else
							{
								echo "<h2>Sorry, there are no topics available!</h2>";
							}
						}
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					?>
                    
				</div>
			</div>

			<!-- Footer -->
			<?php
				include '../footer.php';
			?>
	</body>
</html>
