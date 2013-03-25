<?php
	include '../init.php';
	include '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Add Content</title>
	</head>
	<body>
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Add Content to subtopic</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                    <?php
					//connect to database and start session
					include '../init.php';
					
					//run function
					echo addContent();

					function addContent()
					{
						//get id and content entered, from the URL that was sent from the previous page.
					$subid =  $_GET["subId"];
					$content = $_GET["cont"];
						
						//execute query to get all data in subtopic table
					$result = mysql_query("SELECT * FROM subtopic") or die(mysql_error());
					
						//create new varible for later use
					$isFound = false;
						
						//loop through the array of results searching for a match
					while($row = mysql_fetch_array($result))
					{
						if($subid == $row['SubtopicID'])
						{	//if a match is found set boolean to true
							$isFound=true;
						}
					}
					
					if($content!=null)
					{	//if content varible has a value
						if($isFound)
						{
							//insert/update new records
							mysql_query("UPDATE `subtopic` SET `Content`='".$content."' WHERE SubtopicID = '".$subid."'") or die(mysql_error());
							echo 'Success';
						}
						else
						{//subject id not found(uses $isfirst)
							echo 'SubjectId Does not Exsist';
						}
					}
					else
					{//if content var is null
						echo 'Please enter some content';
					}
					
					}
					
					?>
                </div>

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


