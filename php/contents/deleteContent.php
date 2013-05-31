<?php
	ob_start();
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
		<title>ReviseIT - Delete Content</title>
	</head>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Delete content for a subtopic</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                   <?php
				   try{			
							$result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID =:id");
							$result->bindParam("id", $subtopic_ID);
							$result->execute();   
				   		}
					catch(PDOException $e)
					{
						echo "Not working";
					}
				  	
					while($row = $result->fetch(PDO::FETCH_ASSOC))
					{			   
				   	echo "<h3>Are you certain you wish to delete <u>".$row['SubtopicName']."</u>'s content?</h3>";
					echo "<p>Content that you're deleteing:<br />".$row['Content']."</p>";
					}
				   	echo "<form method='post' action=''><input type='submit' name='submit' value='Delete Contents'/><br />";
					echo "<br /><a href='content.php?ID=".$subtopic_ID."'>No, I do not wish to delete the contents</a>";
				   ?>                   
                </div>
			</div>
		</div>
		
        <?php
	
	if(isset($_POST['submit']))
	{		
		try
		{
		$stmt = $db->prepare("UPDATE `subtopic` SET `Content`= NULL WHERE SubtopicID=:subtopic_ID");
		$stmt->bindParam("subtopic_ID", $subtopic_ID);
		$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo "not working exceptions for deleteion";
		}
		exit(header("Location: content.php?ID=".$subtopic_ID));
		ob_get_flush();
	}
	
	?>
        
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>