<?php
	include '../init.php';
?>

<!DOCTYPE html>
<html>
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width-device-width, initial-scale=1.0">
			<title>ReviseIT - Teacher</title>
			<link rel="stylesheet" href="../../assets/css/version1.css">
			<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
	</head>
	<body>
		
		<!-- This is the navigation bar, it is the black bar at the top of the page.-->
																									<!-- navbar-fixed-top: fixed the bar to the top-->
																									<!-- navbar-inverse: applies dark theme to thebar-->
																									<!-- brand: The title that floats left: reviseIT-->
																									<!-- nav-pull-right: floats nav components to thr right-->
																									<!-- active: gives the list item a highlighted effect-->
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-th-list"></span>
					</a>
					<a href="#" class="brand">reviseIT</a>
					<p class="nav navbar-text">user type: <strong>administrator</strong></p>
					<div class="nav-collapse collapse">
						<ul class="nav pull-right">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Accounts</a></li>
							<li><a href="#">Subjects</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<br /><br />

		<div class="container">
			<?php
				include '../welcome.php';
			?>

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
		
		<!-- This is the same as the navigation bar at the top, except I used it for the footer.-->
		<div class="navbar navbar-fixed-bottom">
			<div class="container">
				<div class="nav-collapse collapse">
					<ul class="nav pull-right">
						<li><a href="#">Log out</a></li>
						<li><a href="#">Help</a></li>
					</ul>
				</div>
			</div>
		</div>

		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
	</body>
</html>