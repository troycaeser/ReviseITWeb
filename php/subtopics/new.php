<?php
	
	require '../getConnection.php';
	require '../check_logged_in.php';
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Add Topic</title>
</head>
<body>
	<?php
		include 'subtopics_menu_bar.php';
	?>

	<br /><br />

<div class="container">

	<div class="page-header">
        <h1>Add Subtopic</h1>
    </div>

	<!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                    <div class='span6'><h4>Subtopic Name</h4></div>
                    <div class='span6'><h4>Brief Description</h4></div>
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>

    <form method="post">
       
    <table width="200" border="0">
    
      <tr>
        <td>
            <label>
                 <input type="text" name="SubtopicName" />
            </label>
        </td>
        <td>
            <label>
                <input type="text" name="briefDescription" />
            </label>
        </td>
      </tr>
      
      <tr align="Left">
        <td colspan="5" >
        <label>
           <input type="submit" name="submit" value="Add Subtopic">
        </label>
        </td>
      </tr>
     </table>
     </form>
         
         </div>
             <!-- Displays subtopics -->
            <div class="span4">
                <ul class="nav nav-list">
                    <li class="nav-header">Quick Access</li>
                    <li class="active"><a href="new.php?ID=<?php echo $TopicID; ?>">Add Subtopic</a></li>
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
<?php
	// Get form data, making sure it is valid
	$SubtopicName = $_POST['SubtopicName'];
	$briefDescription = $_POST['briefDescription'];
	
	// get topic id
	$TopicID = $_GET["ID"];
	
	//get current date
	date_default_timezone_set('Australia/Melbourne');
	$date = date('Y-m-d', time());
	
	// Check if the form has been submitted. If it has, start to process the form and save it to the database
	if (isset($_POST['submit']))
	{ 
		$SQL = $db->prepare("INSERT INTO subtopic VALUES(NULL, :bind_subtopicName, :bind_topicID, :bind_briefDescription, ' ', 0, :bind_date)");
		$SQL->bindParam("bind_subtopicName", $SubtopicName);
		$SQL->bindParam("bind_topicID", $TopicID);
		$SQL->bindParam("bind_briefDescription", $briefDescription);
		$SQL->bindParam("bind_date", $date);
		$SQL->execute();
		
		// Once saved, redirect back to the view page
		header("Location: view.php?ID=".$TopicID."");
	}
?> 