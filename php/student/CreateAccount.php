<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Account</title>
<?php require_once("../../DAL/Verification.php"); require_once("../../DAL/DataAccessLayer.php"); ?>
</head>
<body>
<?php
$setfName = 0;
$setlName = 0;
$setuserName = 0;

$fName = "";
$lName = "";
$userName = "";

if(isset($_POST["submitUser"])){
	if ($_POST["fName"] == NULL)
		$setfName = 1;
	else $fName = $_POST["fName"];
	if ($_POST["lName"] == NULL)
		$setlName = 1;
	else $lName = $_POST["lName"];
	if ($_POST["userName"] == NULL)
		$setuserName = 1;
	else $userName = $_POST["userName"];
	$pass1 = $_POST["pass1"];
	$pass2 = $_POST["pass2"];
	
	if ($pass1 != $pass2)
		echo ("<p class='errmsg'>Passwords do not match!</p>");
	elseif (!verifyPassword($pass1))
		echo ("<p class='errmsg'>Password requires Capital, Small, Numeral and at least eight characters, No Special Characters!</p>");
	else { $pass = md5($pass1);
		createUser($userName, $pass, $fName, $lName, "4");
	}
}
?>
<form method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
<table border="0"><tr><td><label for="fName">Enter First Name</label></td>
<td><input type="text" name="fName" id="fName" value='<?php echo $fName ?>'/></td></tr>
<?php if ($setfName) echo "<tr><td colspan='2' class='errmsg'>Please enter a first name!</td></tr>"; ?>
<tr><td><label for="lName">Enter Last Name</label></td>
<td><input type="text" name="lName" id="lName" value='<?php echo $lName ?>' /></td></tr>
<?php if ($setlName) echo "<tr><td colspan='2' class='errmsg'>Please enter a last name!</td></tr>"; ?>
<tr><td><label for="userName">Enter Username</label></td>
<td><input type="text" name="userName" id="userName" value='<?php echo $userName ?>' /></td></tr>
<?php if ($setuserName) echo "<tr><td colspan='2' class='errmsg'>Please enter a username!</td></tr>"; ?>
<tr><td><label for="pass1">Enter Password</label></td>
<td><input type="password" name="pass1" id="pass1" value='' /></td></tr>
<tr><td><label for="pass2">Confirm Password</label></td>
<td><input type="password" name="pass2" id="pass2" value='' /></td></tr>
<tr><td><input type="submit" name="reset" value="RESET" /></td>
<td><input type="submit" name="submitUser" value="SUBMIT" /></td></tr></table>
</form>
<?php if (isset($POST["reset"])){
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
</body>
</html>
