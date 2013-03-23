<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="version1.css">
        <link rel="stylesheet" href="bootstrap-responsive.css">
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
        VIEW-PAGINATED.PHP
        Displays all the data from the 'subtopic' table
        This is a modified version of view.php that includes pagination
*/

        // Connect to the database
        include('connect-db.php');
		
		
        // Number of results to show per page 
        $per_page = 3;
        
		
        // Determine the total pages in the database
        $result = mysql_query("SELECT * FROM subtopic");
        $total_results = mysql_num_rows($result);
        $total_pages = ceil($total_results / $per_page);

			
        // Check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
        if (isset($_GET['page']) && is_numeric($_GET['page']))
        {
                $show_page = $_GET['page'];
                
                // Ensure the $show_page value is valid
                if ($show_page > 0 && $show_page <= $total_pages)
                {
                        $start = ($show_page -1) * $per_page;
                        $end = $start + $per_page; 
                }
                else
                {
                        // Error - show the first set of results
                        $start = 0;
                        $end = $per_page; 
                }               
        }
        else
        {
                // If the page isn't set, show the first set of results
                $start = 0;
                $end = $per_page; 
        }
	
		
        // Display pagination
        echo "<p><a href='view.php'>View All</a> | <b>View Page:</b>";
		
		
		for ($i = 1; $i <= $total_pages; $i++)
        {
                echo "<a href='view-paginated.php?page=$i'>$i</a> ";
        }
        echo "</p>";
		
		?>

		<!--<p><a href="new.php">Add a new record</a></p>--->
		<!--<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>--->

    
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
                
        // Display data in the table
        // echo "<table border='1' cellpadding='10'>";
        // echo "<tr> <th>Subtopic Name</th> <th>Content</th> <th>Date Updated</th> <th></th> <th></th></tr>";
			
			
        // Loop through the results of the database query, displaying them in the table 
        for ($i = $start; $i < $end; $i++)
        {
                // Ensure that the PHP doesn't try to show results that don't exist
                if ($i == $total_results) { break; }
        				
                // Echo out the contents of each row into a table
                //echo "<tr>";
				
                //echo '<td>' . mysql_result($result, $i, 'id') . '</td>';
				//echo '<a href="content.php?id= $id ' . mysql_result($result, $i, "SubtopicName") . '</a>';
			    echo "<div id='". mysql_result($result, $i, 'SubtopicName')."</div>";
					echo "<div id='".$row['SubtopicName']."' class='row-fluid'>";
						echo "<div class='span3'>" . mysql_result($result, $i, 'SubtopicName')."</div>";
                		echo "<div class='span4'>" . mysql_result($result, $i, 'Content')."</div>";
						echo "<div class='span2'>" . mysql_result($result, $i, 'DateUpdated')."</div>";
						echo "<div class='span1'>".'<a href="edit.php?id=' . mysql_result($result, $i, 'SubtopicID') . '">Edit</a></div>';
						echo "<div class='span1'>".'<a href="delete.php?id=' . mysql_result($result, $i, 'SubtopicID') . '">Delete</a></div>';
				    echo "</div>";
				echo "</a>";
				
        }
        // Close table>
        // echo "</table>"; 
		
		
        
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
			include 'footer.php';
		?>
    		
                
</body>
</html> 