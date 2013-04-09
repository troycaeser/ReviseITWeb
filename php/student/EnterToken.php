<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enter Login Token</title>
<?php require_once("../../DAL/DataAccessLayer.php");
$settoken = 0;
$token = "";
?>
</head>
<body>
	<?php
		if (isset($_POST["submitNToken"])){
			if ($_POST["token"] == NULL)
		            $settoken = 1;
		    else { $token = $_POST["token"];
				if (enterToken($token))
				header("Location: CreateAccount.php");
			}
		}
	?>
<form method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
<table border="0"><tr><td><label for="token">Enter Token</label></td>
<td><input type="text" name="token" id="token"  value="<?php echo($token); ?>" /></td></tr>
<?php if ($settoken) echo "<tr><td colspan='2' class='errmsg'>Please enter a token!</td></tr>"; ?>
<tr><td><input type="reset" name="reset" value="RESET" /></td>
<td><input type="submit" name="submitNToken" value="SUBMIT" /></td></tr></table>
</form>
	<?php
		if (isset($POST["reset"])){
			$settoken = 0;
			$token = "";
		}
	?>

</body>
</html>