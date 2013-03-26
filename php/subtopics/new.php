<?php
	
	require '../init.php';
	require '../check_logged_in.php';
	
	// get the current path
	$current_url = $SERVER['PHP SELF'];

	// process into bits
	$path_parts = pathinfo($current_url);
	
	// get topic id
	$TopicID = $_GET["ID"];
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
<?php
	/* 
	 NEW.PHP
	 Allows user to create a new entry in the database
	*/
	 
?>

	<!-- subtopicname, content, date updated-->
    	<div class="row-fluid">
        	<div class="span8">
            	<div class='row-fluid'>
                    <div class='span6'><h4>Subtopic Name</h4></div>
                    <div class='span6'><h4>Date</h4></div>
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>
                       
<?php	 
	 
	 // Creates the new record form
	 // Function created since, this form is used multiple times in this file
	 function renderForm($Subt, $Date, $error)
	 {
		 // If there are any errors, display them
		 if ($error != '')
		 {
			echo '<div>'.$error.'</div>';
		 }
	 } 
	 
	 // Check if the form has been submitted. If it has, start to process the form and save it to the database
	 if (isset($_POST['submit']))
	 { 
		 // Get form data, making sure it is valid
		 $SubtopicName = $_POST['SubtopicName'];
		 //$Content = $_POST['Content'];
		 $DateUpdated = $_POST['DateUpdated'];
		 
		 //subtopic records
		 //SubtopicID, SubtopicName, TopicID, Content, Downloads, DateUpdated
		 //you need to have a way to get:
		 //TopicID, Contents, DateUpdated (preferrably today).

		 //Topic -> Subtopic.

		 // Save the data to the database
		 $SQL = mysql_query("INSERT INTO subtopic VALUES(NULL, '".$SubtopicName."', '".$DateUpdated."', 0")
			 		or die(mysql_error()); 
					
		 $cSQL = mysql_query($SQL);
			
		 $query = mysql_query ($cSQL);
			
		 $query2 = "SELECT * from subtopic";
			 
		 $queryCall = mysql_query($query2, $db);
			 
		 $realData = mysql_result($data, 0, 'topic.SubjectID');
		 
	 
		 // Check to make sure all fields are filled in
		 if ($SubtopicName == '' || $DateUpdated == '')
		 {
			 // Generate error message
			 $error = 'ERROR: Please fill in all required fields!';
		 
			 // If either field is blank, display the form again
			 renderForm($SubtopicName, $DateUpdated, $error);
	 	 }
	 
		 else
		 {
			 // Once saved, redirect back to the view page
			 header("Location: view.php"); 
		 }
	 }
	 // If the form hasn't been submitted, display the form
	 else
	 {
	 	renderForm('','','','');
	 }
?> 

    <form action="" method="post">
       
    <table width="200" border="0">
    
      <tr>
        <td>
            <label>
                 <input type="text" name="SubtopicName" />
            </label>
        </td>
        <td>
            <label>
                <input type="text" name="DateUpdated" />
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