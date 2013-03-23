<?php
	include '../init.php';

	$subtopic_ID = $_GET['ID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../../assets/css/version1.css">
        <link rel="stylesheet" href="../../../assets/css/bootstrap-responsive.css">
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
                    <div class='span4'><h4>Subtopic Name</h4></div>
                    <div class='span4'><h4>Content</h4></div>
                    <div class='span4'><h4>Date</h4></div>
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>           
<?php	 
	 
	 $subtopic_ID = $_GET['ID'];
	 
	function renderForm($subtopic_ID, $subtopic_Name, $Content, $DateUpdated, $error)
	{
		// If there are any errors, display them
		if ($error != '')
		{
			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
		}
	}
				 
	 // Check if the form has been submitted. If it has, process the form and save it to the database
	 if (isset($_POST['submit']))
	 {
				
				$subtopic_Name = $_POST['SubtopicName'];
		 		$Content = $_POST['Content'];
		 		$DateUpdated = $_POST['DateUpdated'];
				
				 // Save the data to the database
				 mysql_query("UPDATE subtopic SET SubtopicName='".$subtopic_Name."', Content='$Content', 
				 			  DateUpdated='$DateUpdated' WHERE SubtopicID='$subtopic_ID'")

				 
				 or die(mysql_error());

				 $top_id = mysql_query("SELECT TopicID FROM subtopic WHERE SubtopicID='".$subtopic_ID."'");
				 $topic_ID = mysql_result($top_id, 0, "TopicID");
			 
				 // Once saved, redirect back to the view page
				 header("Location: view.php?ID=".$topic_ID.""); 
			 }

	 // If the form hasn't been submitted, get the data from the db and display the form
	 else
	 {
	 
	 // Get the 'id' value from the URL (if it exists), making sure that it is valid 
	 //(checing that it is numeric/larger than 0)
	 if (isset($_GET['ID']) && is_numeric($_GET['ID']) && $_GET['ID'] > 0)
	 {
		 // Query db
		 $subtopic_ID = $_GET['ID'];
		 $result = mysql_query("SELECT * FROM subtopic WHERE SubtopicID='".$subtopic_ID."'")
		 or die(mysql_error()); 
		 $row = mysql_fetch_array($result);
	 
		 // Check that the 'id' matches up with a row in the database
		 if($row)
		 {
			 // Retrieve data from db
			 $subtopic_Name = $row['SubtopicName'];
			 $topic_ID = $row['TopicID'];
			 $Content = $row['Content'];
			 $DateUpdated = $row['DateUpdated'];
			 
			 // Display form
			 renderForm($subtopic_ID, $subtopic_Name, $Content, $DateUpdated, '');
		 }
		 // If there is no match, display result
		 else
		 {
		 	echo "No results!";
		 }
	 }
	 else
	 // If the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
	 {
	 	echo 'Error!';
	 }
   }
   
   // http://twitter.github.com/bootstrap/base-css.html#tables
?>


<form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $subtopic_ID; ?>"/>
       
<table width="200" border="0">

  
  <tr>
    <td>
    	<label>
        	 <input type="text" name="SubtopicName" value="<?php echo $subtopic_Name; ?>"/>
        </label>
    </td>
    <td>
    	<label>
         	<span class="input-xlarge uneditable-input"><?php echo $Content; ?></span>
        </label>
    </td>
    <td>
    	<label>
         	<input type="text" name="DateUpdated" value="<?php echo $DateUpdated; ?>"/>
        </label>
    </td>
  </tr>
  
  <tr align="Left">
    <td colspan="5" >
    <label>
       <input type="submit" name="submit" value="Edit Record">
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