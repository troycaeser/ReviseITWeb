<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<title>ReviseIT - Teacher</title>
<link rel="stylesheet" href="../../assets/css/version1.css">
<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">
<?php
	include '../init.php';
	if ($_GET['ROLE'] != NULL) $role = $_GET['ROLE'];

?>
</head>
<body>

<!-- This is the navigation bar, it is the black bar at the top of the page.--> 
<!-- navbar-fixed-top: fixed the bar to the top--> 
<!-- navbar-inverse: applies dark theme to thebar--> 
<!-- brand: The title that floats left: reviseIT--> 
<!-- nav-pull-right: floats nav components to thr right--> 
<!-- active: gives the list item a highlighted effect-->
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-th-list"></span> </a> <a href="#" class="brand">reviseIT</a>
      <p class="nav navbar-text">user type: <strong>administrator</strong></p>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="active"><a href="admin_Home.php">Home</a></li>
          <li><a href="#">Accounts</a></li>
          <li><a href="#">Subjects</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<br />
<br />
<div class="container">
<?php
	include '../php/php/welcome.php';
?>
<div class="page-header">
  <h1>All Accounts</h1>
</div>
<div class='row-fluid'> 
  <!-- Displays All subjects -->
  <?php


		//get result from the table "subject"
		if ($role == "5" || $role == NULL) $result = mysql_query("SELECT * FROM users ORDER BY role ASC") or die(mysql_error());
		elseif ($role == "6") $result = mysql_query("SELECT * FROM users WHERE role = 2 OR role = 3 ORDER BY role ASC") or die(mysql_error());
		else $result = mysql_query("SELECT * FROM users WHERE role = ".$role) or die(mysql_error());
		//opening the first section of the row-fluid. (span 8)
?>
  <div class='span8'>
    <div class='row-fluid'>
    <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
      <div class='span4'>
        <input type='submit' value='CREATE NEW ACCOUNT' name='newAccnt' class='btn' />
      </div>
      <div class='span4'>
        <select name='listRole'>
          <option>All</option>
          <option>Admin</option>
          <option>Coordinator</option>
          <option>Teacher (All)</option>
          <option>Teacher (Non-coordinator)</option>
          <option>Student</option>
        </select>
      </div>
      <div class='span4'>
        <input type='submit' value='LIST ACCOUNTS' name='newList' class='btn' />
      </div>
    </form>
  </div>
    <div class='row-fluid'>
      <div class='span6'>
        <h4>Username</h4>
      </div>
      <div class='span2'>
        <h4>First Name</h4>
      </div>
      <div class='span2'>
        <h4>Last Name</h4>
      </div>
      <div class='span2'>
        <h4>Role</h4>
      </div>
    </div>
    <?php
			//displa everything in a row-fluid/spans while looping the result.
			while($row = mysql_fetch_array($result)){
				echo "<div class='row-fluid'>";
					echo "<div class='span6'>".$row['username']."</div>";
					echo "<div class='span2'>".$row['fName']."</div>";
					echo "<div class='span2'>".$row['lName']."</div>";
					echo "<div class='span2'>";
					if ($row['role'] == "1") echo 'Admin'; 
					else if ($row['role'] == "2") echo 'Co-ordinator'; 
					else if ($row['role'] == "3") echo 'Teacher'; 
					else if ($row['role'] == "4") echo 'Student';  
					echo"</div>";
				echo "</div>";
			}
		echo "</div>";

if (isset($_POST['newList'])){
	$lrole = ($_POST['listRole']);
	switch ($lrole) {
		case "All": $role = 5; break;
		case "Admin": $role = 1; break;
		case "Coordinator": $role = 2; break;
		case "Teacher (All)": $role = 6; break;
		case "Teacher (Non-coordinator)": $role = 3; break;
		case "Student": $role = 4; break;
	}
		header ("Location: all_Accounts.php?ROLE=$role.");
}

if (isset($_POST['newAccnt'])){
	header ('Location: CreateUser.php');
}
?>
    <div class="span4">
      <ul class="nav nav-list">
        <li class="nav-header">Quick Access</li>
        <li class="active"><a href="#">Create Accounts</a></li>
        <li><a href="#">Subject Roles</a></li>
        <li><a href="#">Account details</a></li>
        <li><a href="#">My account</a></li>
        <li class="divider"></li>
        <li><a href="#">About Us</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- This is the same as the navigation bar at the top, except I used it for the footer.-->
<div class="navbar navbar-fixed-bottom">
  <div class="container">
    <div class="nav-collapse collapse">
      <ul class="nav pull-right">
        <li><a href="#">Log out</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script> 
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>