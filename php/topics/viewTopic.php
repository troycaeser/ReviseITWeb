<?php
	require'../init.php';
	require '../check_logged_in.php';

	$subject_ID = $_GET['ID'];

	//$path_parts['filename'] echoes out the last part of the url.
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
				<?php
					include '../welcome.php';
				?>

				<div class="page-header">
					<h1>Topics Lists</h1>
				</div>
				
				<div class="row-fluid">
					<?php

						//select topic accoding to subject id.
						$query = "SELECT * FROM topic WHERE SubjectID = '".$subject_ID."'";

						$SQL = mysql_query($query)
							or die("Problem loading query ".mysql_error());
						
						$roleQuery = "SELECT * FROM users WHERE role = 4";
						$roleSQL = mysql_query($roleQuery)
							or die("Problem: cannot loading query ".mysql_error());
						if($roleSQL)
						{
							echo "<div class='span8'>";
								echo"<div class='row-fluid'>";
									echo "<div><h4>Topic Name</h4></div>";
								echo "</div>";
								
								while($row = mysql_fetch_array($SQL))
								{
								$id=$row['TopicID'];
								
								echo "<a href='../subtopics/view.php?ID=".$row['TopicID']."'>";	
										echo "<div>".$row['TopicName']."</div>";
									
								echo "</a>";
	
								}
								echo '<br><a href="newtopic.html">Add New Topic</a>';
								echo "</div>";
						}
						
						if($SQL)
						{
							echo "<div class='span8'>";
								echo"<div class='row-fluid'>";
									echo "<div class='span3'><h4>Topic Name</h4></div>";
									echo "<div class='span6'><h4>Edit Topic</h4></div>";
									echo "<div class='span3'><h4>Delete Topic</h4></div>";
								echo "</div>";
	
							while($row = mysql_fetch_array($SQL))
							{
								$id=$row['TopicID'];
								
								echo "<a href='../subtopics/view.php?ID=".$row['TopicID']."'>";	
										echo "<div class='span3'>".$row['TopicName']."</div>";
										echo "<div class='span6'><a href='editTopic.php?ID=".$row['TopicID']."'>".Edit."</a></div>";
										echo "<div class='span3'><input type='button' value='Delete' onclick='confirm_delete()'></div>";
									
								echo "</a>";
	
							}
							echo '<br><a href="newtopic.html">Add New Topic</a>';
							echo "</div>";
						}
					?>
                    
					<div class="span4">
						<ul class="nav nav-list">
							<li class="nav-header">Quick Access</li>
							<li class="active"><a href="../subjects/create_subject.php">Create Subjects</a></li>
							<li><a href="#">Account details</a></li>
							<li><a href="#">My account</a></li>
							<li class="divider"></li>
							<li><a href="#">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<?php
				include '../footer.php';
			?>

		<script>	
			function confirm_delete(id)
			{
				var deleteIT = confirm('Do you wish to mark this record for deletion?');
				
				if(deleteIT)
				{
					<?php
						$id=$row['TopicID'];
						
						echo "window.location.href = 'deleteTopic.php?ID=".$row['TopicID']."'";
					?>
				}
				else
				{
					location.reload(true);
				}
			}
		</script>
	</body>
</html>
