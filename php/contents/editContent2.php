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
		<title>ReviseIT - Edit Content</title>
	</head>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Edit Content for a subtopic</h1>
			</div>
            
            <?php
				
				echo go();
				
				function go()
				{
					//gets value from url
					$subid =  $_GET["subId"];
					
					//gets all info in subtopic
					$result = mysql_query("SELECT * FROM subtopic") or die(mysql_error());
					$isFound = false;
							
					while($row = mysql_fetch_array($result))
					{
						if($subid == $row['SubtopicID'])
						{
							$isFound=true;
							$cont = $row['Content'];
						} //checks to see if users string matches any in the db
					}
		
					if($isFound) //if it does -->
					{
						echo'<form action="editCont.php" method="get">
						<div class="row-fluid">
							<div class="2"><h4>Subtopic ID</h4></div><div class="span6"><input type="text" name="sub" value="'.$subid.'"></div>
						</div>
						
						<div class="row-fluid">
							<div class="2"><h4>Content</h4></div><div class="span8"><textarea name="cont" rows="3">'.$cont.'</textarea></div>
						</div>
                    <input type="submit">
					</div>
                    </form>';//wrties forms that will post info into url for later use
						
					}
					else
					{	//if no matches
						echo 'SubjectId Does not Exsist\nPlease Press Back and try again';
					}
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