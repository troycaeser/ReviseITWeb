<?php
  	include '../getConnection.php';
	require '../check_logged_in.php';

	//$UserID = $_GET['ID'];
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
        <h1>Edit Account</h1>
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
	 
	// $UserID = $_GET['ID'];
	 /*
	function renderForm($UserID, $fName, $lName, $username, $password, $error)
	{
		// If there are any errors, display them
		if ($error != '')
		{
			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
		}
	}
		*/
		/*		 
	 // Check if the form has been submitted. If it has, process the form and save it to the database
	 if (isset($_POST['submit']))
	 {
		 		$username = $_GET['ID'];
				
				$q = "UPDATE users SET username = :bind_username, fName = :bind_fName,
					  lName = :bind_lName, password = :bind_password WHERE UserID = :bind_UserID";
		
				$query = $db->prepare($q);
				
				$query->bindParam('bind_UserID', $UserID);
				$query->bindParam('bind_fName', $fName);
				$query->bindParam('bind_lName', $lName);
				$query->bindParam('bind_username', $username);
				$query->bindParam('bind_password', $password);
				$query->execute();

				header("Location: all_Accounts.php");
						 
  	 }
	 
	 
	 */
	 
	 //----------------------

	 if (isset($_POST['submit']))
	 {
		try{
	   
			//write query
			//in this case, it seemed like we have so many fields to pass and
			//its kinda better if we'll label them and not use question marks
			//like what we used here
			
			$query = "UPDATE users SET fName = :fName, lName = :lName, 
					 username = :username, password = :password WHERE UserID = :UserID";
			
			
			//prepare query for excecution
			$stmt = $db->prepare($query);
			
			//bind the parameters
			$stmt->bindParam(':fName', $_POST['fName']);
			$stmt->bindParam(':lName', $_POST['lName']);
			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':password', $_POST['password']);
			$stmt->bindParam(':UserID', $_POST['UserID']);
		   
			// Execute the query
			$stmt->execute();
		   
			echo "Record was updated.";
	   
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

		try {
			//prepare query
			$query = "SELECT UserID, fName, lName, username, password FROM users WHERE UserID = UserID";
			$stmt = $db->prepare( $query );
		   
			//this is the first question mark
			$stmt->bindParam(2, $_REQUEST['UserID']);
		   
			//execute our query
			$stmt->execute();
		   
			//store retrieved row to a variable
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			//values to fill up in form
			$UserID = $row['UserID'];
			$fName = $row['fName'];
			$lName = $row['lName'];
			$username = $row['username'];
			$password = $row['password'];
		   
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
	}
  
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 //----------------------
	 
	 
/*
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
   */
   
   // http://twitter.github.com/bootstrap/base-css.html#tables
?>


<form class="form-horizontal" action="" method="post">
<input type='hidden' name='UserID' value='<?php echo $UserID ?>' />
       
<table width="100" border="0">
    <td>
    	<tr>
            <label>
                <input type="text" name="fName" id="fName" value='<?php echo $fName; ?>'/>
            </label>
     	</tr>
    	<tr>
            <label>
                <input type="text" name="lName" id="lName" value='<?php echo $lName; ?>' />
            </label>
    	</tr>
   		<tr>
            <label>
                <input type="text" name="username" id="username" value='<?php echo $username; ?>' />
            </label>
    	</tr>
    	<tr>
            <label>
                <input type="password" name="password" id="password" value='<?php echo $password;  ?>' />
            </label>
    	</tr>
    	<tr>     
             <!-- we will set the action to edit -->
			<input type="submit" name="submit" value="Edit" />
            <input type="submit" name="delete" value="Delete" />
             
             <a href='all_Accounts.php'>All Accounts</a>
    	</tr>
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