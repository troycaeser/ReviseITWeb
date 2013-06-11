<?php
	require'../getConnection.php';
	require '../check_logged_in.php';

	$subject_ID = $_GET['ID'];
	$userRole = $_SESSION['Role'];
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

				<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="The Topics" data-bootstro-content="This page contains all the topics associated with your subject.">
					<h1>List of Topics</h1>
				</div>
				
				<div class="row-fluid bootstro" data-bootstro-placement="bottom" data-bootstro-title="Topic Lists" data-bootstro-content="This is the list of topics. You may click into one of these topics to see their associated subtopics.">
					<?php
					$userRole = $_SESSION['Role'];
					
					try
					{
						if($userRole != 2)
						{
							//SQL query used to display the topic(s) corresponding to the subject id
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
							
							//Checks whether there is at least 1 topic associated to a subject, if there is then display, otherwise display an error message
							if($TopicResult >= 1)
							{
								echo "<div class='span8'>";
									echo"<div class='row-fluid'>";
										echo "<div class='span4'><h4>Topic Name</h4></div>";
										include '../checkCoord2.php';
								
										if($coordCorrect == true)
										{
										echo "<div class='span4'><h4>Edit Topic</h4></div>";
										echo "<div class='span4'><h4>Delete Topic</h4></div>";
										}
									echo "</div>";
		
								while($row = $result->fetch(PDO::FETCH_ASSOC))
								{
									$id=$row['TopicID'];
									
									echo "<a href='../subtopics/view.php?ID=".$row['TopicID']."'>";	
											echo "<div class='span4'>".$row['TopicName']."</div>";
											echo "</a>";
								
										if($coordCorrect == true)
										{
											echo "<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit' data-bootstro-content='Click on this link to edit this topic.'><a href='editTopic.php?ID=".$row['TopicID']."'>Edit</a></div>";
											echo "<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Delete' data-bootstro-content='Click on this link to delete this topic'><a onclick='deleteTopic(".$row['TopicID'].");'>Delete</a></div>";
										}
										else
										{
											echo "<div class='span6'></div>";
											echo "</a>";
										}
									
		
								}
									if($coordCorrect == true)
										{
								echo "<a class='btn bootstro' data-bootstro-placement='bottom' data-bootstro-title='Create New Topic' data-bootstro-content='Create a new topic for this subject!' href='newTopic.php'>Add New Topic</a>";
								echo "</div>";
										}
							}
							else
							{
								echo "<h2>Sorry, there are no topics available!</h2>";
									if($coordCorrect == true)
										{
								echo '<a href="newtopic.php">Add New Topic</a>';
										}
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
			<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
			<script src="../../assets/js/bootstrap.js"></script>
			<script src="../../assets/js/bootstro.min.js"></script>
			<script>
			$(document).ready(function()
			{
				$('#help').click(function()
				{
					bootstro.start(".bootstro");
				});
			});
			
			function deleteTopic(id)
			{
				var delete_IT = confirm("Do you wish to mark topic for deletion?");
			
				if(delete_IT)
				{
					alert("Topic marked for deletion");
					//the following page will only perform delete and header.
					window.location.href = 'deleteTopic.php?ID=' + id;
				}
				else
				{
					location.reload();
				}
			}
			</script>
	</body>
</html>
