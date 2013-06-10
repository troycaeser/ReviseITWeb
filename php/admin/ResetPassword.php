<?php
	ob_start();
	require '../getConnection.php';
    require "../../DAL/Verification.php"; 
	
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

<div class="container">

	<div class="page-header">
        <h1>Reset Password</h1>
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

	$setUser=0;

	if (isset($_POST['submit']))
    {
		try {
	 
	 		 $username = $_POST['username'];
			 
			 $query = $db->prepare("SELECT * FROM users WHERE username = :bind_username");
			 $query->bindParam(':bind_username', $username);
			 $query->execute();
	 
			 if ($query->rowCount() == 0) {
				$setUser=1;
			 }
			 
			 else {
				$setUser=0;
				exit(header("Location: NewPassword.php?ID=".$username));
				ob_get_flush();
				
			}
		} catch (PDOException $e) {
			die ($e->getMessage());
		}
	
	}

?> 
     
     <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
        <div class="center">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="username">Enter Username</label>
              <div class="controls">
                <input type="text" id="username" name="username" />
              </div>
            </div>
            <?php if ($setUser == 1) echo "<p class='errmsg'>User does not exist!</p>";
			//else if ($setsName == 2) echo "<p class='errmsg'>Please enter a valid Email Address!</p>"; ?>
            <div class="controls">
              <input class="btn" type="submit" name="submit" value="Submit" />
            </div>
          </fieldset>
        </div>
      </form>
 		
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>                       
</body>
</html> 

