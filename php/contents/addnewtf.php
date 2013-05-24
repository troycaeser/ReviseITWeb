<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
		include '../header_container.php';
	?>
<title>ReviseIT -Add New True/False Test Question</title>
</head>
<body>
<?php
		include '../subtopics/subtopics_menu_bar.php';
	?>
<div class="container">
  <div class="page-header">
    <h1>Add New True/False Question</h1>
  </div>
  <?php 

if(isset($_POST['addnewtf'])){

	$testID = $_GET['ID'];	
	$question = $_POST["qtf"];				
	$answer = $_POST["radio_group"];				
	
	$sql = "INSERT INTO truefalse (Question, correctAns, TestID) VALUES ('".$question."', '".$answer."', '".$testID."');";

	$query = $db->prepare($sql);
	$query->execute(); 		
	
	echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit Test Questions' data-bootstro-content='View Test Question in Current Test.'>
		<h3>Added Test Question!</h3>
		<p>Edit Test Questions</p>
		<a href='EditTestQuestions.php?ID=".$testID."'>View Test</a>
	</div>";
	echo "	</div>
</div>";
	include '../footer.php';         
echo "</body>
</html> ";
	exit;
} else echo "<p class='errmsg'>Error !</p>";
?>
</div>
</div>
<?php
	include '../footer.php';
?>
</body>
</html>
