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
  <title>ReviseIT - Accounts</title>
</head>
<body>

<?php
  include 'admin_menu_bar.php';
?>
<br /><br />

<div class="container">
<div class="page-header">
  <h1>All Accounts</h1>
</div>
<div class='row-fluid'> 
  <!-- Displays All subjects -->
  <?php

		//get result from the table "subject"
		if ($role == 5 || $role == NULL)
		{
			$result = $db->prepare("SELECT * FROM users ORDER BY role ASC");
      		$result->execute();
    	}
		else if ($role == 6)
		{
			$result = $db->prepare("SELECT * FROM users WHERE role = 2 OR role = 3 ORDER BY role ASC");
			$result->execute();
    	}
		else
		{
     		$result = $db->prepare("SELECT * FROM users WHERE role = ".$role);
      		$result->execute();
    	}
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
          <option>Student</option>
          <option>Teacher (All)</option>
          <option>Teacher (Non-coordinator)</option>
        </select>
      </div>
      <div class='span4'>
        <input type='submit' value='LIST ACCOUNTS' name='newList' class='btn' />
      </div>
    </form>
  </div>
    <div class='row-fluid'>
      <div class='span3'>
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
      <div class='span3'>
        <h4>Account Status</h4>
      </div>
    </div>
    <?php
			//displa everything in a row-fluid/spans while looping the result.
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				echo "<a href='../admin/EditAccount.php?ID=".$row['UserID']."'>";
				echo "<div class='row-fluid'>";
					echo "<div class='span3'>".$row['username']."</div>";
					echo "<div class='span2'>".$row['fName']."</div>";
					echo "<div class='span2'>".$row['lName']."</div>";
					echo "<div class='span2'>";
						if ($row['role'] == "1") echo 'Admin'; 
						else if ($row['role'] == "2") echo 'Co-ordinator'; 
						else if ($row['role'] == "3") echo 'Teacher'; 
						else if ($row['role'] == "4") echo 'Student';
					echo"</div>";
					
					echo "<div class='span3'>";
						echo "<div class'row-fluid'>";
							echo "<div class='span6'>";
								if ($row['locked'] == "1") echo 'Locked';
								else if ($row['locked'] != "1 | 0") echo 'Current';
							echo "</div>";
							echo "<div class='span6'>";
								if ($row['locked'] == "1") echo '<a href="UnlockAccount.php?ID=' . $row['username'] . '">Unlock</a>';
								else if ($row['locked'] == "0") echo '<a href="LockAccount.php?ID=' . $row['username'] . '">Lock</a>';
							echo "</div>";
						echo "</div>";
					echo"</div>";
					
			}
			
		echo "</div>";

if (isset($_POST['newList']))
{
	$lrole = ($_POST['listRole']);
	switch ($lrole) 
	{
		case "All": $role = 5; break;
		case "Admin": $role = 1; break;
		case "Coordinator": $role = 2; break;
		case "Student": $role = 4; break;
		case "Teacher (All)": $role = 6; break;
		case "Teacher (Non-coordinator)": $role = 3; break;
	}
		header ("Location: all_Accounts.php?ROLE=$role");
}

if (isset($_POST['newAccnt']))
{
	header ('Location: CreateUser.php');
}
?>
    <div class="span4">
      <ul class="nav nav-list">
        <li class="nav-header">Quick Access</li>
        <li class="active"><a href="CreateUser.php">Create Accounts</a></li>
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