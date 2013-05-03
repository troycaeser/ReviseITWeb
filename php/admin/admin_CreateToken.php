<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
<head>
<?php
			include '../header_container.php';
		?>
<title>ReviseIT - Create Token</title>
</head>
<body>
<?php
			include 'admin_menu_bar.php';
		?>
<br />
<br />
<div class="container">
  <div class="page-header">
    <h1>Create Token</h1>
  </div>
  <div class='row-fluid'> 
    <!-- Displays Links -->
    
    <?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	require_once("../../DAL/DataAccessLayer.php");
	require_once("../../DAL/Verification.php");
	$settoken = 0;
	$token = "";

	if (isset($_POST["submitNToken"])){
		$settoken = 0;
		if ($_POST["token"] == NULL)
	        $settoken = 1;
		else { 
			$token = $_POST["token"];
			if(!(isAlphaNumeric($token)))
				$settoken = 2;
			else {
				createToken($token);
				header("Location: admin_Home.php");	
			}
		}
	}
?>
    <div class="container">
      <form class="form-horizontal" method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
        <div class="center">
          <fieldset>
            <div class="control-group bootstro" data-bootstro-placement="bottom" data-bootstro-title="The Token" data-bootstro-content="Enter a <b>token</b> in the textfield below.">
              <label class="control-label" for="token">Enter New Token: </label>
              <div class="controls">
                <input type="text" name="token" id="token" value="<?php echo($token); ?>" />
              </div>
            </div>
            
            <!-- Error message -->
            <?php if ($settoken == 1) echo "<div class='errmsg'>Please enter a token!</div>";
				elseif ($settoken == 2) echo "<div class='errmsg'>Please enter a valid token!</div>"; ?>
            <div class="controls">
              <button class="btn bootstro" data-bootstro-placement="bottom" data-bootstro-title="Reset" data-bootstro-content="click this button to reset token back to <b>blank</b>." type="submit" name="reset">Reset</button>
              <button class="btn bootstro" data-bootstro-placement="bottom" data-bootstro-title="Submit" data-bootstro-content="Create the token by click submit." type="submit" name="submitNToken">Submit</button>
            </div>
          </fieldset>
        </div>
      </form>
    </div>
    <?php 
	if (isset($POST["reset"])){
		$settoken = 0;
		$token = "";
	}
?>
  </div>
</div>

<!-- Footer -->
<?php
			include '../footer.php';
		?>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script> 
<script src="../../assets/js/bootstro.min.js"></script> 
<script>
		$(document).ready(function()
		{
			$('#help').click(function()
			{
				bootstro.start(".bootstro", 
				{
					finishButton: ''
				});
			});
		});
		</script>
</body>
</html>