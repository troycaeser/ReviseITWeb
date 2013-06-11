<?php
	ob_start();
	include '../getConnection.php';
	require "../../DAL/Subtopic.php"; 
	require "../../DAL/Verification.php"; 
	require '../check_logged_in.php';

	$TopicID = $_GET["ID"];
	
		include '../checkCoord.php';
								
	if($coordCorrect != true)
	{
	exit(header('location: ../notCoord.php'));
	ob_get_flush();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Edit Subtopic</title>
</head>
<body>
	<?php
		include 'subtopics_menu_bar.php';
	?>

	<br /><br />

<div class="container">

	<div class="page-header">
        <h1>Edit Subtopic</h1>
    </div>

<?php
	/* 
	 EDIT.PHP
	 Allows user to edit a specific entry in the database
	*/
	
	 // Creates the edit record form
	 // Function created since, this form is used multiple times in this file

?>

<!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                   <!-- <div class='span5'><h4>Subtopic Name</h4></div>-->
                   <!-- <div class='span5'><h4>Description</h4></div>-->
                   <!-- <div class='span2'><h4>Last Updated</h4></div>-->
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>           
                
<?php	 

	
    $subtopic_ID = $_GET['ID'];
	$details = getDetails($subtopic_ID);
	
	$subtopic_Name = $details->SubtopicName;
	$description = $details->SubtopicBriefDescription;
	$date = $details->DateUpdated;


	$setsName = 0;
	$setdesc = 0;
	
	// Check if the form has been submitted. If it has, start to process the form and save it to the database
	if (isset($_POST['submit']))
	{

		if (empty($_POST["SubtopicName"]))
			$setsName = 1;
			
		else{
			$SubtopicName = $_POST["SubtopicName"];
			if (!isString($SubtopicName))
			$setsName = 2;
			else $setsName = 0;
		}
	
		if (empty($_POST["SubtopicBriefDescription"]))
			$setdesc = 1;
	
		else if(($setsName == 0) && ($setdesc == 0)){

	 		try {
				date_default_timezone_set('Australia/Melbourne');
				$date = date('Y-m-d', time());
	
				$stmt = $db->prepare("UPDATE subtopic SET SubtopicName=:subtopic_Name, SubtopicBriefDescription=:description,
						 DateUpdated=:date WHERE SubtopicID=:subtopic_ID");
				
				// get topic id
				$TopicID = $_GET["ID"];	
				
				//bind the parameters
				$stmt->bindParam(':subtopic_ID', $subtopic_ID);
				$stmt->bindParam(':subtopic_Name', $_POST['SubtopicName']);
				$stmt->bindParam(':description', $_POST['SubtopicBriefDescription']);
				$stmt->bindParam(':date', $date);
				$stmt->execute();
						
				$stmt=$db->prepare("SELECT TopicID FROM subtopic WHERE SubtopicID=:subtopic_ID");
				$stmt->bindParam(':subtopic_ID', $subtopic_ID);
				$stmt->execute();
				$TopicID = $stmt->fetchColumn();
	
				// return to all accounts page
				exit(header("Location: view.php?ID=".$TopicID));
				ob_get_flush();
		}
		catch (PDOException $e){
			echo "Could not edit Subtopic";
			return false;
		}
		
		try{
				$stmt = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID=:subtopic_ID");
				$stmt->bindParam(":subtopic_ID", $_GET['ID']);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				//values to fill up in form
				$subtopic_Name = $row['SubtopicName'];
				$description = $row['SubtopicBriefDescription'];
				$date = $row['DateUpdated'];
		   
		}
		catch (PDOException $e){
			echo "Could not edit record";
		//return false;
		}

	}
}
		
?>

      <form class="form-horizontal" method="post"  action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="center">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="SubtopicName">Subtopic Name</label>
              <div class="controls">
                <input type="text" name="SubtopicName" id="SubtopicName" value='<?php echo $subtopic_Name ?>'/>
              </div>
            </div>
            <?php if ($setsName == 1) echo "<p class='errmsg'>Please enter a subtopic name!</p>";
            else if ($setsName == 2) echo "<p class='errmsg'>Please enter a valid subtopic name!</p>"; ?>
            <div class="control-group">
              <label class="control-label" for="SubtopicBriefDescription">Description</label>
              <div class="controls">
                <textarea  class='textareaA' type="textarea" name="SubtopicBriefDescription" id="SubtopicBriefDescription"><?php echo $description ?></textarea>
              </div>
            </div>
            <?php if ($setdesc == 1) echo "<p class='errmsg'>Please enter a description!</p>";
            else if ($setdesc == 2) echo "<p class='errmsg'>Please enter a valid description!</p>"; ?>
            <div class="control-group">
              <label class="control-label" for="date">Last Updated</label>
              <div class="controls">
                <span class="input-xlarge uneditable-input"> <?php echo $date; ?></span>
              </div>
            </div>
            <input type="hidden" name="subtopic_ID" id="subtopic_ID" value="<?php echo $subtopic_ID; ?>"/>
            <div class="controls">
              <input class="btn" type="submit" name="submit" value="Edit" />
            </div>
          </fieldset>
        </div>
      </form>

    <!-- Footer -->
		<?php
			include '../footer.php';
		?>
    		
<div>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>                
</body>
</html>  