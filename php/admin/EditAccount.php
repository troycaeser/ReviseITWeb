<?php
  	include '../getConnection.php';
	require '../check_logged_in.php';

	$userID = $_GET['ID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<?php
			include '../header_container.php';
		?>
		<title>ReviseIT - Edit User</title>
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
                    <div class='span3'><h4>First Name</h4></div>
                    <div class='span3'><h4>Last Name</h4></div>
                    <div class='span3'><h4>Username</h4></div>
                    <div class='span3'><h4>Password</h4></div>
                    <!--<div class='span2'><h4>Coordinator</h4></div>-->
				</div>           
<?php	 
	 
	 $UserID = $_GET['ID'];
	 
	function renderForm($UserID, $fName, $lName, $username, $password, $error)
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
				
				$username = $_POST['username'];
		 		$fName = $_POST['fName'];
		 		$lName = $_POST['lName'];
				$password = $_POST['password'];
				
				 // Save the data to the database
				 mysql_query("UPDATE users SET username='".$username."', fName='$fName', 
				 			  lName='$lName' password='$password' WHERE UserID='$UserID'")

				 
				 or die(mysql_error());
			 
				 // Once saved, redirect back to the view page
				 //header("Location: view.php?ID=".$topic_ID.""); 
			 }

	 // If the form hasn't been submitted, get the data from the db and display the form
	 else
	 {
	 
	 // Get the 'id' value from the URL (if it exists), making sure that it is valid 
	 //(checing that it is numeric/larger than 0)
	 if (isset($_GET['ID']) && is_numeric($_GET['ID']) && $_GET['ID'] > 0)
	 {
		 // Query db
		 $UserID = $_GET['UserID'];
		 $result = $db->prepare("SELECT * FROM users WHERE UserID='".$UserID."'")
		 $stmt->execute();
		 $row=$stmt->fetchALL(PDO::FETCH_OBJ);
	 
		 // Check that the 'id' matches up with a row in the database
		 if($row)
		 {
			 // Retrieve data from db
			 $fName = $row['fName'];
			 $lName = $row['lName'];
			 $username = $row['username'];
			 $password = $row['password'];
			 
			 // Display form
			 renderForm($UserID, $fName, $lName, $username, $password, '');
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
<input type="hidden" name="id" value="<?php echo $UserID; ?>"/>
       
<table width="200" border="0">
    <td>
    	<label>
        	<input type="text" name="fName" id="fName" value='<?php echo $fName ?>'/>
        </label>
    </td>
    <td>
    	<label>
        	<input type="text" name="lName" id="lName" value='<?php echo $lName ?>' />
        </label>
    </td>
    <td>
    	<label>
        	<input type="text" name="username" id="username" value='<?php echo $username ?>' />
        </label>
    </td>
    <td>
    	<label>
       		<input type="password" name="password" id="password" value='' />
        </label>
    </td>
    <td>
    	<label>
        	<input type="submit" name="submitUser" value="Edit" />
        </label>
    </td>
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