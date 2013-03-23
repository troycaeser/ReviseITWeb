<?php
	include '../init.php';

	$topic_ID = $_GET['ID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../../assets/css/version1.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
</head>
<body>
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

	<div class="page-header">
        <h1>Subtopics</h1>
    </div>

<?php
/* 
        VIEW.PHP
        Displays all data from 'subtopic' table
*/

        // Get results from the database
        $result = mysql_query("SELECT * FROM subtopic WHERE TopicID ='".$topic_ID."'") 
                or die(mysql_error());  
                
        // Display data in table
        //echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        //echo "<table border='1' cellpadding='10'>";
        //echo "<tr> <th>Subtopic Name</th> <th>Content</th> <th>Date Updated</th> <th></th> <th></th></tr>";

        // Loop through results of database query, displaying them in the table
        
        // Close table>
        //echo "</table>";
		
?>

<!--<p><a href="new.php">Add a new record</a></p>--->
	<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>

    
    <!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                    <div class='span3'><h4>Subtopic Name</h4></div>
                    <div class='span4'><h4>Content</h4></div>
                    <div class='span2'><h4>Date</h4></div>
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>
            
            
            <?php
				while($row = mysql_fetch_array( $result )) {
						
						// Echo out the contents of each row into a table
						//echo "<tr>";
						
						$id=$row['SubtopicID'];
						
						//echo '<td>' . $row['id'] . '</td>';
						/*echo '<td><a href="content.php?id= $id "> ' . $row["SubtopicName"]. '</a></td>';
						echo '<td>' . $row['Content'] . '</td>';
						echo '<td>' . $row['DateUpdated'] . '</td>';
						echo '<td><a href="edit.php?id=' . $row['SubtopicID'] . '">Edit</a></td>';
						echo '<td><a href="delete.php?id=' . $row['SubtopicID'] . '">Delete</a></td>';
						echo "</tr>"; */
						
						//echo contents in divs
						echo "<a href='../contents/content.php?ID=".$row['SubtopicID']."'>";
							echo "<div id='".$row['SubtopicName']."' class='row-fluid'>";
								echo "<div class='span3'>".$row['SubtopicName']."</div>";
								echo "<div class='span4'>".$row['Content']."</div>";
								echo "<div class='span2'>".$row['DateUpdated']."</div>";
								echo "<div class='span1'>".'<a href="edit.php?ID=' . $row['SubtopicID'] . '">Edit</a></div>';
								echo "<div class='span1'>".'<a href="delete.php?ID=' . $row['SubtopicID'] . '">Delete</a></div>';	
							echo "</div>";
						echo "</a>";
				} 
			?>
           	
            </div>
            
             <!-- Displays subtopics -->
            <div class="span4">
                <ul class="nav nav-list">
                    <li class="nav-header">Quick Access</li>
                    <li class="active"><a href="new.php">Add Subtopic</a></li>
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
    		
                
</body>
</html> 