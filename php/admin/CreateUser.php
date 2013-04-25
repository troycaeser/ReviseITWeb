<?php
  include '../getConnection.php';
  require '../check_logged_in.php';
?>

<!DOCTYPE html>
<html>
<head>
<?php 
  require_once("../../DAL/Verification.php"); 
  require_once("../../DAL/DataAccessLayer.php");
  include '../header_container.php';
?>
</head>
<body>
</head>
<body>
  <?php
    include 'admin_menu_bar.php';
  ?>
<br /><br />
<div class="container">
  <div class="page-header">
    <h1>Revise IT - Create New User Account</h1>
  </div>
  <div class='row-fluid'>
    <div class='span8'>
      <?php
$setfName = 0;
$setlName = 0;
$setuserName = 0;

$fName = "";
$lName = "";
$userName = "";

if(isset($_POST["submitUser"]))
{
	if($row['username'] == $userName && $row['password'] == $pass1 && $row['password'] == $pass2)
	{
		echo "Username and password are already in use. Please enter a different username & password";
	}
	else
	{
		if ($_POST["fName"] == NULL)
			$setfName = 1;
		else $fName = $_POST["fName"];
		if ($_POST["lName"] == NULL)
			$setlName = 1;
		else $lName = $_POST["lName"];
		if ($_POST["userName"] == NULL)
			$setuserName = 1;
		else $userName = $_POST["userName"];
		$pass1 = md5($_POST["pass1"]);
		$pass2 = md5($_POST["pass2"]);
		
		if ($pass1 != $pass2)
			echo ("<p class='errmsg'>Passwords do not match!</p>");
		elseif (!verifyPassword($pass1))
			echo ("<p class='errmsg'>Password requires Capital, Small, Numeral and at least eight characters, No Special Characters!</p>");
		else { $pass = md5($pass1);
			createUser($userName, $pass, $fName, $lName, "3");
			header('Location: admin_Home.php');
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
            <?php if ($setfName) echo "<tr><td colspan='2' class='errmsg'>Please enter a first name!</td></tr>"; ?>
            <div class="control-group">
              <label class="control-label" for="lName">Enter Last Name</label>
              <div class="controls">
                <input type="text" name="lName" id="lName" value='<?php echo $lName ?>' />
              </div>
            </div>
            <?php if ($setlName) echo "<tr><td colspan='2' class='errmsg'>Please enter a last name!</td></tr>"; ?>
            <div class="control-group">
              <label class="control-label" for="userName">Enter Username</label>
              <div class="controls">
                <input type="text" name="userName" id="userName" value='<?php echo $userName ?>' />
              </div>
            </div>
            <?php if ($setuserName) echo "<tr><td colspan='2' class='errmsg'>Please enter a username!</td></tr>"; ?>
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
              <input class="btn" type="submit" name="submitUser" value="SUBMIT" />
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
  <div class="span4">
    <ul class="nav nav-list">
      <li class="nav-header">Quick Access</li>
      <li class="active"><a href="#">Help</a></li>
      <li><a href="#">Contact Admin</a></li>
      <li><a href="#">My Account</a></li>
    </ul>
  </div>
</div>
</div>
<div class="navbar navbar-fixed-bottom">
  <div class="container">
    <div class="nav-collapse collapse">
      <ul class="nav pull-right">
        <li><a href="../logout.php">Log out</a></li>
        <li><a href="#">Contact Admin</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>