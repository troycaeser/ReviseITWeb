<?php
  include '../getConnection.php';
  require '../check_logged_in.php';
  require '../../DAL/DataAccessLayer.php';
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
	$subjects = getSubjects();
?>
<title>reviseIT - Assign Subject To Coordinator</title>
</head>

<body>
<?php
  include 'admin_menu_bar.php';
	$id = $_GET['ID'];
?>
<br />
<br />

<div class="container">
  <div class="page-header">
    <h1>Assign Subject Coordinator</h1>
  </div>
  <?php
if (isset($_POST['submitCoord'])){
	$str = $_POST['subjects'];
	$arr = explode(" ",$str);
	$subjectID = $arr[0];
	assignCoord($subjectID, $id);
	echo"<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Assign Coordinator' data-bootstro-content='Click on the link to view Accounts'>
		<h3>View Accounts!</h3>
		<p>View All Accounts!</p>
		<a href='all_Accounts.php'>View Accounts</a><br />";
		include '../footer.php';
	exit;
}
?><div class="row-fluid">
    <form class="form-horizontal" method="post" action='<?php echo $_SERVER["PHP_SELF"]."?ID=".$id; ?>'>
      <div class="center">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="subjects">Select Subject</label>
            <div class="controls">
              <select name='subjects' id='subjects'>
                <?php while ($row = $subjects->fetch(PDO::FETCH_OBJ)){
                  echo "<option>".$row->SubjectID." ".$row->SubjectCode." ".$row->SubjectName."</option>";
				  }
				  ?>
              </select>
            </div>
          </div>
          <div class="controls">
            <input class="btn" type="submit" name="submitCoord" value="ASSIGN TO COORDINATOR" />
          </div>
        </fieldset>
      </div>
    </form>
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