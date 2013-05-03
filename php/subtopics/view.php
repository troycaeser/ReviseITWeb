<?php
	include '../getConnection.php';
	require '../check_logged_in.php';

	$topic_ID = $_GET['ID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		include '../header_container.php';
	?>
	<title>ReviseIT - Subtopics</title>
</head>
<body>
	<?php
		include 'subtopics_menu_bar.php';
	?>

	<br /><br />

<div class="container">

	<div class="page-header">
        <h1>Subtopic</h1>
    </div>

<?php
/* 
        VIEW.PHP
        Displays all data from 'subtopic' table
*/

        // Get results from the database
        $result = $db->prepare("SELECT * FROM subtopic WHERE TopicID ='".$topic_ID."'") ;
        $result->execute();         
		
                
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
<<<<<<< HEAD
				while($row = $result->fetch(PDO::FETCH_ASSOC))
=======
				while($row = $result->fetch(PDO::FETCH_ASSOC)) 
>>>>>>> origin/master
				{	
						$id=$row['SubtopicID'];
						
						//echo contents in divs
						echo "<a href='../contents/content.php?ID=".$row['SubtopicID']."'>";
							echo "<div id='".$row['SubtopicID']."' class='row-fluid'>";
								echo "<div class='span3'>".$row['SubtopicName']."</div>";
								echo "<div class='span4'>".$row['Content']."</div>";
								echo "<div class='span2'>".$row['DateUpdated']."</div>";
								echo "<div class='span1'>".'<button name="edit"><a href="edit.php?ID=' . $row['SubtopicID'] . '">Edit</a></button></div>';
								echo "<div class='span1'>".'<button name="delete"><a href="delete.php?ID=' . $row['SubtopicID'] . '">Delete</a></button></div>';	
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
                    <li><a href="../account/my_account.php">My account</a></li>
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