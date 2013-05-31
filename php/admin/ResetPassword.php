<?php
	ob_start();
	require '../getConnection.php';
    require "../../DAL/Verification.php"; 
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
                    <!--<div class='span6'><h4>Subtopic Name</h4></div>-->
                    <!--<div class='span6'><h4>Brief Description</h4></div>-->
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>

<?php

	$setEmail = 0;

	// Check if the form has been submitted. If it has, start to process the form and save it to the database
	if (isset($_POST['submit']))
	{

		if (empty($_POST["Email"]))
			$setEmail = 1;
			
		else{
			$SubtopicName = $_POST["SubtopicName"];
			if (!isString($SubtopicName))
			$setsName = 2;
			else $setsName = 0;
		}
	
		if (empty($_POST["briefDescription"]))
			$setdesc = 1;
	
		else if(($setsName == 0) && ($setdesc == 0)){
			
			try{
					// get topic id
					$TopicID = $_GET["ID"];
					$SubtopicName = $_POST['SubtopicName'];
					$briefDescription = $_POST['briefDescription'];
		
					//get current date
					date_default_timezone_set('Australia/Melbourne');
					$date = date('Y-m-d', time());
				
					// Check if the form has been submitted. If it has, start to process the form and save it to the database
					$SQL = $db->prepare("INSERT INTO subtopic VALUES(NULL, :bind_subtopicName, :bind_topicID, :bind_briefDescription, ' ', 0, :bind_date)");
					$SQL->bindParam("bind_subtopicName", $SubtopicName);
					$SQL->bindParam("bind_topicID", $TopicID);
					$SQL->bindParam("bind_briefDescription", $briefDescription);
					$SQL->bindParam("bind_date", $date);
					$SQL->execute();
						
					// Once saved, redirect back to the view page
					exit(header("Location: view.php?ID=".$TopicID));
					ob_get_flush();
			}
			catch (PDOException $e){
				echo "Could not add record";
				//return false;
			}
		}
	}
?> 
     
     <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
        <div class="center">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="Email">Enter Email Address</label>
              <div class="controls">
                <input type="text" id="Email" name="Email" />
              </div>
            </div>
            <?php if ($setsName == 1) echo "<p class='errmsg'>Please ensure an Email Address has been entered!</p>";
			else if ($setsName == 2) echo "<p class='errmsg'>Please enter a valid Email Address!</p>"; ?>
            <div class="controls">
              <input class="btn" type="submit" name="submit" value="Send" />
            </div>
          </fieldset>
        </div>
      </form>
 
         </div>

             <!-- Displays subtopics -->
            <div class="span4">
                <ul class="nav nav-list">
                    <li class="nav-header">Quick Access</li>
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
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>                       
</body>
</html> 

