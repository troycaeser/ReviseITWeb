<?php
  require '../getConnection.php';
  require '../check_logged_in.php';
  include '../check_role.php';
  checkRoleCod($_SESSION['Role']);
  checkRoleStudent($_SESSION['Role']);
  checkRoleTeacher($_SESSION['Role']);
?>

<!DOCTYPE html>
<html>
<head>
<?php 
  require "../../DAL/Verification.php"; 
  require "../../DAL/DataAccessLayer.php";
  include '../header_container.php';
?>
</head>
<body>
<?php
    include 'admin_menu_bar.php';
  ?>
<br />
<br />
<div class="container">
  <div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="Create Accounts Page" data-bootstro-content="Welcome to the create accounts page. In here you may create accounts and their usernames.">
    <h1>Revise IT - Create New User Account</h1>
  </div>
  <div class='row-fluid'>
    <div class='span8 bootstro' data-bootstro-placement="right" data-bootstro-title="Accounts Form" data-bootstro-content="Enter the user's details in this form to create an account.">
      <?php
$setfName = 0;
$setlName = 0;
$setuserName = 0;

$fName = "";
$lName = "";
$userName = "";

if(isset($_POST["submitUser"]))
{
		if ($_POST["fName"] == NULL)
			$setfName = 1;
		else {
			$fName = $_POST["fName"];
			if (!isString($fName))
			$setfName = 2;
			else $setfName = 0;
		}
		if ($_POST["lName"] == NULL)
			$setlName = 1;
		else {
			$lName = $_POST["lName"];
			if (!isString($lName))
			$setlName = 2;
			else $setlName = 0;
		}
		if ($_POST["userName"] == NULL)
			$setuserName = 1;
		else {
			$userName = $_POST["userName"];
			if (!isAlphaNumeric($userName))
			$setuserName = 2;
			else $setuserName = 0;
		}
			$lrole = ($_POST['listRole']);
			switch ($lrole) 
			{
				case "Admin": $xrole = 1; break;
				case "Coordinator": $xrole = 2; break;
				case "Student": $xrole = 4; break;
				case "Teacher (Non-coordinator)": $xrole = 3; break;
			}

		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		if ($pass1 != $pass2)
			echo ("<p class='errmsg'>Passwords do not match!</p>");
		elseif (!verifyPassword($pass1))
			echo ("<p class='errmsg'>Password requires Capital, Small, Numeral and at least eight characters, No Special Characters!</p>");
		elseif (($setfName == 0) && ($setlName == 0) && ($setuserName == 0)){
			$pass = $pass1; 
			$error = "";
			$role = $xrole;
			if($xrole == 2) $role = 3;			
			$error = createUser($userName, $pass, $fName, $lName, $role);
			if($error === "error") echo "<p class='errmsg'>Username already exists</p>";
			else{
				$id = $error;
				if ($xrole == 2) {
					echo"<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Assign Coordinator' data-bootstro-content='Click on the link to assign a Subject for the new Co-ordinator to control.'>
		<h3>Assign Subject!</h3>
		<p>Assign Subject to Coordinator!</p>
		<a href='assign_CoordinatorSubject.php?ID=".$id."'>Assign Subject</a><br />";
				include '../footer.php';
				exit;
				}
 				else {
				echo"<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Assign Coordinator' data-bootstro-content='Click on the link to view Accounts'>
		<h3>View Accounts!</h3>
		<p>View All Accounts!</p>
		<a href='all_Accounts.php'>View Accounts</a><br />";
				include '../footer.php';
				exit;
				}
			}
	}
}
?>
      <form class="form-horizontal" method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
        <div class="center">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="fName">Enter First Name</label>
              <div class="controls">
                <input type="text" name="fName" id="fName" value='<?php echo $fName ?>'/>
              </div>
            </div>
            <?php if ($setfName == 1) echo "<p class='errmsg'>Please enter a first name!</p>";
			elseif ($setfName == 2) echo "<p class='errmsg'>Please enter a valid first name!</p>"; ?>
            <div class="control-group">
              <label class="control-label" for="lName">Enter Last Name</label>
              <div class="controls">
                <input type="text" name="lName" id="lName" value='<?php echo $lName ?>' />
              </div>
            </div>
            <?php if ($setlName == 1) echo "<p class='errmsg'>Please enter a last name!</p>";
			elseif ($setlName == 2) echo "<p class='errmsg'>Please enter a valid last name!</p>"; ?>
            <div class="control-group">
              <label class="control-label" for="userName">Enter Username</label>
              <div class="controls">
                <input type="text" name="userName" id="userName" value='<?php echo $userName ?>' />
              </div>
            </div>
            <?php if ($setuserName == 1) echo "<p class='errmsg'>Please enter a username!</p>";
			elseif ($setuserName == 2) echo "<p class='errmsg'>Please enter a valid username!</p>"; ?>
            <div class="control-group">
              <label class="control-label" for="listRole">Select Account Type</label>
              <div class="controls">
                <select name='listRole' id='listRole'>
                  <option <?php if ($xrole == 1) echo " selected='selected'"; ?>>Admin</option>
                  <option <?php if ($xrole == 2) echo " selected='selected'"; ?>>Coordinator</option>
                  <option <?php if ($xrole == 3) echo " selected='selected'"; ?>>Teacher (Non-coordinator)</option>
                  <option <?php if ($xrole == 4) echo " selected='selected'"; ?>>Student</option>
</option>
                </select>
              </div>
            </div>
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
              <input class="btn bootstro" data-bootstro-placement="right" data-bootstro-title="submit and Create" data-bootstro-content="Click this button to create the account. Remember, make sure all your fields are entered <b>correctly</b>!" type="submit" name="submitUser" value="SUBMIT" />
              <input class="btn" type="submit" name="reset" value="RESET" />
            </div>
          </fieldset>
        </div>
      </form>
    </div>
    <?php if (isset($POST["reset"]))
	{
		$setfName = 0;
		$setlName = 0;
		$setuserName = 0;
	
		$fName = "";
		$lName = "";
		$userName = "";
		$pass1 = "";
		$pass2 = "";
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