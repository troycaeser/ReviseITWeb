<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<title>ReviseIT - Student</title>
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
<?php require_once("../../DAL/DataAccessLayer.php");
$settoken = 0;
$token = "";
?>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-th-list"></span> </a> <a href="#" class="brand">reviseIT</a>
      <p class="nav navbar-text">user type: <strong>student</strong></p>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="active"><a href="../index.php">Home</a></li>
          <li><a href="../php/subjects/all_Subjects.php">Subjects</a></li>
          <li><a href="#">Enrol</a></li>
          <li><a href="#">Account</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<br />
<br />


<div class="container">

  <div class="welcome">
    <h5>Welcome, Student</h5>
  </div>
  
  <div class="page-header">
    <h1>Revise IT - Student Access</h1>
  </div>
  
  <div class='row-fluid'>
  	<div class='span8'>
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
    <form method="post" class="form-horizontal" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
      <div class="center">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="token">Enter Token</label>
            <div class="controls">
              <input type="text" name="token" id="token"  value="<?php echo($token); ?>" />
            </div>
          </div>
          <?php if ($settoken) echo "<tr><td colspan='2' class='errmsg'>Please enter a token!</td></tr>"; ?>
          <div class="controls">
            <input class="btn" type="submit" name="reset" value="RESET" />
            <input class="btn" type="submit" name="submitNToken" value="SUBMIT" />
          </div>
        </fieldset>
      </div>
    </form>
    
    <?php
		if (isset($POST["reset"])){
			$settoken = 0;
			$token = "";
		}
	?>
    </div>
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
        <li><a href="#">Log out</a></li>
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