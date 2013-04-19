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
					<h1>Topics Lists</h1>
				</div>
				
				<div class="row-fluid">
					<?php
					try
					{
						//select topic accoding to subject id.
						$result = $db->prepare("SELECT * FROM topic WHERE SubjectID = '".$subject_ID."'");
						$result->execute();
						
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
										echo "<div class='span6'><a href='editTopic.php?ID=".$row['TopicID']."'>".Edit."</a></div>";
										echo "<div class='span3'><a href='deleteTopic.php?ID=".$row['TopicID']."'>".Delete."</a></div>";	
								echo "</a>";
	
							}
							echo '<br><a href="newtopic.html">Add New Topic</a>';
							echo "</div>";
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					?>
                    
					<div class="span4">
						<ul class="nav nav-list">
							<li class="nav-header">Quick Access</li>
							<li><a href="../subjects/create_subject.php">Create Subjects</a></li>
							<li><a href="#">Account details</a></li>
							<li><a href="../account/my_account.php">My account</a></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<?php
				include '../footer.php';
			?>
	</body>
</html>
