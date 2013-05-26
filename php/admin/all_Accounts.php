<?php
	include '../getConnection.php';
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
			<div class="page-header bootstro" data-bootstro-placement="bottom" data-bootstro-title="All Accounts" data-bootstro-content="Welcome to the accounts page. In here, you can see all the user information. You may create, edit and delete them.">
				<h1>All Accounts</h1>
			</div>

			<div class='row-fluid bootstro' data-bootstro-placement="bottom" data-bootstro-title="Accounts" data-bootstro-content="This is where all the account information are stored, it contains information like their name, their roles (access level) and if their account is locked or not. You can perform various actions such as, lock the account, edit or delete the account."> 
				<?php
					if (isset($_GET["ROLE"])) $xrole = $_GET["ROLE"];
					else $xrole = 5;

					if (isset($_POST['newList']))
					{
						$lrole = ($_POST['listRole']);
						switch ($lrole) 
						{
							case "All": $xrole = 5; break;
							case "Admin": $xrole = 1; break;
							case "Coordinator": $xrole = 2; break;
							case "Student": $xrole = 4; break;
							case "Teacher (All)": $xrole = 6; break;
							case "Teacher (Non-coordinator)": $xrole = 3; break;
						}
						//header("Location: all_Accounts.php?ROLE=".$xrole);
					}

					if ($xrole == 5 || $xrole == NULL)
					{
						$result = $db->prepare("SELECT * FROM users ORDER BY role ASC");
						$result->execute();
					}
					else if ($xrole == 6)
					{
						$result = $db->prepare("SELECT * FROM users WHERE role = 2 OR role = 3 ORDER BY role ASC");
						$result->execute();
					}
					else
					{
						$result = $db->prepare("SELECT * FROM users WHERE role = ".$xrole);
						$result->execute();
					}
					//opening the first section of the row-fluid. (span 8)
				?>
				<div class='span8'>
					<div class='row-fluid'>
						<div class='span4 bootstro' data-bootstro-placement="bottom" data-bootstro-title="Create new Account" data-bootstro-content="Click this button to create a new account!">
							<form action='CreateUser.php' method='post'>
								<input type='submit' value='CREATE NEW ACCOUNT' name='newAccnt' class='btn' />
							</form>
						</div>

						<form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
							<div class='span4 bootstro' data-bootstro-placement="right" data-bootstro-title="Filters" data-bootstro-content="Click this drop down menu to select various options to filter the way you'd like to view the accounts.">
								<select name='listRole'>
									<option <?php if ($xrole == 5) echo " selected='selected'"; ?>>All</option>
									<option <?php if ($xrole == 1) echo " selected='selected'"; ?>>Admin</option>
									<option <?php if ($xrole == 2) echo " selected='selected'"; ?>>Coordinator</option>
									<option <?php if ($xrole == 4) echo " selected='selected'"; ?>>Student</option>
									<option <?php if ($xrole == 6) echo " selected='selected'"; ?>>Teacher (All)</option>
									<option <?php if ($xrole == 3) echo " selected='selected'"; ?>>Teacher (Non-coordinator)</option>
								</select>
							</div>
							<div class='span4'>
								<input type='submit' value='LIST ACCOUNTS' name='newList' class='btn bootstro' data-bootstro-placement="right" data-bootstro-title="Filters" data-bootstro-content="After selecting the the option from the dropdown menu, click this button to list and filter the page." />
							</div>
						</form>
					</div>

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
						<div class='span2'>
							<h4></h4>
						</div>
					</div>
					<?php
						//display everything in a row-fluid/spans while looping the result.
						while($row = $result->fetch(PDO::FETCH_ASSOC))
						{
							//echo "<a href='../admin/EditAccount.php?ID=".$row['UserID']."'>";
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

								echo "<div class='span2'>";
									echo "<div class'row-fluid'>";
										echo "<div class='span6'>";
											if ($row['locked'] == "1") echo 'Locked';
											else echo 'Active';
										echo "</div>";
										echo "<div class='span6'>";
											if ($row['locked'] == "1") 

											echo '<a href="UnlockAccount.php?ID=' . $row['username'] . '">Unlock</a>';
											else if ($row['locked'] == "0") echo '<a href="LockAccount.php?ID=' . $row['username'] . '">Lock</a>';
										echo "</div>";
									echo "</div>";
								echo"</div>";

								echo "<div class='span2'>";
									echo "<div class'row-fluid'>";
										echo "<div class='span6'>";
											echo "<div class='span1'>".'<a href="EditAccount.php?ID=' . $row['UserID'] . '">Edit</a></div>';	
										echo "</div>";
										echo "<div class='span6'>";
											echo "<div class='span1'>".'<a href="DeleteAccount.php?ID=' . $row['UserID'] . '">Delete</a></div>';
										echo "</div>";
									echo "</div>";
								echo"</div>";
							echo "</div>";
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