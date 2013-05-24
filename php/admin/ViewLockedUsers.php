<?php
  include '../getConnection.php';
  require '../check_logged_in.php';
  include '../check_role.php';
  checkRoleCod($_SESSION['Role']);
  checkRoleStudent($_SESSION['Role']);
  checkRoleTeacher($_SESSION['Role']);
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
  include 'admin_menu_bar.php';
?>
<br /><br />

<div class="container">
<div class="page-header">
  <h1>View Locked Accounts</h1>
</div>
  <!-- Displays all locked accounts -->
  <?php
			$result = $db->prepare("SELECT * FROM users WHERE locked = 1");
      		$result->execute();
  ?>
	<!-- Headings -->
    <div class='row-fluid'>
      <div class='span2'>
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
      <div class='span2'>
        <h4>Account Status</h4>
      </div>
    </div>
    
    
    <?php
			// display all locked users
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				echo "<div class='row-fluid'>";
					echo "<div class='span2'>".$row['username']."</div>";
					echo "<div class='span2'>".$row['fName']."</div>";
					echo "<div class='span2'>".$row['lName']."</div>";
					echo "<div class='span2'>";
					
					if ($row['role'] == "1") echo 'Admin'; 
					else if ($row['role'] == "2") echo 'Co-ordinator'; 
					else if ($row['role'] == "3") echo 'Teacher'; 
					else if ($row['role'] == "4") echo 'Student';
					echo"</div>"; 
					
					if ($row['locked'] == "1") echo 'Locked'; 
					
				
				//echo "<div class='span1'>".'<a href="UnlockAccount.php?ID=' . $row['username'] . '">Unlock</a></div>';	
				echo "</div>";
			}
		echo "</div>";	

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

<!-- Footer navigation bar.-->
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