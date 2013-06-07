<?php
	ob_start();
	include '../getConnection.php';
	require '../check_logged_in.php';
	$User_ID = $_GET['UserID'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		include '../header_container.php';
	?>
</head>
<body>
	<?php
		include 'subtopics_menu_bar.php';
	?>

	<br /><br />

<div class="container">

	<div class="page-header">
        <h1>Test results</h1>
    </div>

<?php
/* 
        VIEW.PHP
        Displays all data from 'subtopic' table
*/  
                
        // Display data in table
        //echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        //echo "<table border='1' cellpadding='10'>";
        //echo "<tr> <th>Subtopic Name</th> <th>Content</th> <th>Date Updated</th> <th></th> <th></th></tr>";

        // Loop through results of database query, displaying them in the table
        
        // Close table>
        //echo "</table>";
		
		//$result = $db->prepare("SELECT * FROM results WHERE UserID = '".$User_ID."'");
		//$result->execute(); 
		
?>

<!--<p><a href="new.php">Add a new record</a></p>--->
<!--<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>-->

    
    <!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                    <div class='span3'><h4>Subject Name</h4></div>
                    <div class='span3'><h4>Topic Name</h4></div>
                    <div class='span3'><h4>Subtopic Name</h4></div>
                    <div class='span3'><h4>Test Result</h4></div>
				</div>
            
            
            <?php
			
			if($_SESSION['Role'] == 1|| $_SESSION['Role'] == 2)
			{

			}

			else{
				
				while($row = $result->fetch(PDO::FETCH_ASSOC)) 
				{		
						$Result = $row['Result'];
						$User_ID = $row['UserID'];
						//$firstName = $row['fName'];
						//$lastName = $row['lName'];
						
						// Get results from the database
						//$result = $db->prepare("SELECT * FROM results WHERE UserID = '".$User_ID."'");
						//$result->execute();    
						$result = $db->prepare("SELECT * FROM results WHERE UserID = '".$User_ID."'");
						$result->execute(); 
		
						//$user_query = $db->prepare("SELECT UserID, fName, lName FROM users WHERE UserID = :bind_userID");
						//$user_query->bindParam("bind_userID", $User_ID);
						//$user_query->execute();   
		
						//echo contents in divs
						echo "<div class='well'>";
							//echo "<a href='../contents/content.php?ID=".$row['UserID']."'>";
								echo "<div class='row-fluid'>";
									//echo "<div class='span3'>".$row['SubjectName']."</div>";
									//echo "<div class='span3'>".$row['TopicName']."</div>";
									//echo "<div class='span3'>".$row['SubtopicName']." ".$row['lName']."</div>";
									echo "<div class='span3'>".$row['Result']."</div>";
								echo "</div>";
							echo "</a>";
						echo "</div>";
						echo "</br>";
						
				}
				
			}
			?>            
            
            </div>
            
             <!-- Displays subtopics -->
            <div class="span4">
                <ul class="nav nav-list">
                    <li class="nav-header">Quick Access</li>
                    <li><a href="#">Account details</a></li>
                    <!--<li><a href="../account/my_account.php">My account</a></li>-->
                    <li class="divider"></li>
                    <!--<li><a href="#">About Us</a></li>-->
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