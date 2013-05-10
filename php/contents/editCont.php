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
		<title>ReviseIT - Edit Content</title>
	</head>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Edit content for  <?php  try{			
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
                <div class='span8'>
                	<div class='row-fluid'>
						<div class='span2'><h4>Date</h4></div>
                        <div class='span6'><h4>Content</h4></div>
                	</div>
                
                    <?php
					try{			
							$result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID =:id");
							$result->bindParam("id", $subtopic_ID);
							$result->execute();   
							
							while($row = $result->fetch(PDO::FETCH_ASSOC))
							{
								echo "<div class='row-fluid'>";
									echo "<div class='span2'>".$row['DateUpdated']."</div>";
									echo "<div class='span6'><form method='post' action=''><input type='text' value='".$row['Content']."' name='newCont'/></div>";
									echo "<div class='span2'><input type='submit' name='submit' value='Update Contents'/></form></div>";
								echo "</div>";
								echo "<br />"; 
							}
							echo "</div>";
						}
				catch(PDOException $e)
				{
					echo "Not working";
				}
						//$str = "UPDATE `subtopic` SET `Content`='".$content."' WHERE SubtopicID = '".$subid."'";
			?>
                </div>
	<?php
	
	if(isset($_POST['submit']))
	{	
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y-m-d', time());
	
		$newCont = $_POST['newCont'];	
		
		//$newCont = "My Cont";
		
		try
		{
		$stmt = $db->prepare("UPDATE subtopic SET Content=:newCont, DateUpdated=:date WHERE SubtopicID=:subtopic_ID");
		$stmt->bindParam("date", $date);
		$stmt->bindParam("newCont", $newCont);
		$stmt->bindParam("subtopic_ID", $subtopic_ID);
		$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo "not working exceptions ";
		}
		header("Location: content.php?ID=".$subtopic_ID);
	}
	
	?>
				<div class="span4">
					<ul class="nav nav-list">
						<li class="nav-header">Quick Access</li>
						<li class="active"><a href="#">Create Accounts</a></li>
						<li><a href="#">Subject Roles</a></li>
						<li><a href="#">Account details</a></li>
						<li><a href="#">My account</a></li>
						<li class="divider"></li>
						<li><a href="#">About Us</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
			include '../footer.php';
		?>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>


