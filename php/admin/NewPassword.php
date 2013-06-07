<?php
	ob_start();
	require '../getConnection.php';
    require "../../DAL/Verification.php"; 
	
	$username = $_GET["ID"];
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
        <h1>New Password</h1>
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

	if (isset($_POST['submit']))
    {
		try{
				$pass1 = $_POST["pass1"];
				$pass2 = $_POST["pass2"];
				
				if ($pass1 !== $pass2)
					echo ("<p class='errmsg'>Passwords do not match!</p>");
				elseif (!verifyPassword($pass1))
					echo ("<p class='errmsg'>Password must contain Capital, Small, Numeral and at least eight characters, No Special Characters!</p>");
				else
				{	
					$password = md5($pass2);
					$SQL = $db->prepare("UPDATE users SET password = :bind_password WHERE username = :bind_username");
					$SQL->bindParam(":bind_password", $password);
					$SQL->bindParam(":bind_username", $username);
					$SQL->execute();
					
					//exit(header("Location: ../../index.php"));
					//ob_get_flush();
					
					echo"<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Assign Coordinator' data-bootstro-content='Click on the link to view Accounts'>
					<h3>Home</h3>
					<p>Password has been successfully reset!</p>
					<a href='../../index.php'>Return to login</a><br />";
					include '../footer.php';
					exit;
				
				}
		}
		catch (PDOException $e){
			echo "Could not reset password";
			//return false;
		}
	}

?> 
     
     <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
        <div class="center">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="pass1">Enter Password</label>
              <div class="controls">
                <input type="password" name="pass1" id="pass1" value='' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="pass2">Confirm Password</label>
              <div class="controls">
                <input type="password" name="pass2" id="pass2" value='' />
              </div>
            </div>
            <div class="controls">
              <input class="btn bootstro" data-bootstro-placement="right" data-bootstro-title="submit" type="submit" name="submit" value="Reset" />
            </div>
          </fieldset>
        </div>
      </form>
    
		
<!-- Footer -->
<?php
	include '../footer.php';
?> 		
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/bootstro.min.js"></script>                   
</body>
</html> 

