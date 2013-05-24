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
<title>ReviseIT -Add New Multichoice Test Question</title>
</head>
<body>
<?php
		include '../subtopics/subtopics_menu_bar.php';
	?>
<div class="container">
  <div class="page-header">
    <h1>Add New Multichoice Test Question</h1>
  </div>
  <?php 

if(isset($_POST['addnewmulti'])){

	$testID = $_GET['ID'];	
	$question = $_POST["qmc"];
	$answer1 = $_POST["qmca"];		
	$answer2 = $_POST["qmcb"];		
	$answer3 = $_POST["qmcc"];		
	$answer4 = $_POST["qmcd"];
	$answer = $_POST["rdo_group"];
				
		if (($question == "") || ($answer1 == "") || ($answer2 == "") || ($answer3 == "") || ($answer4 == "")){
			echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit Test Questions' data-bootstro-content='View Test Question in Current Test.'>
		<h3>Your Question has Blank Fields, Please Correct Them!</h3>
		<p>Edit Test Questions</p>
		<a href='EditTestQuestions.php?ID=".$stuff."'>View Test</a>
	</div>";
	echo "	</div>
</div><br /><br />";
	include '../footer.php';         
echo"</body>
</html> ";
exit;
		}

	$sql = "INSERT INTO multichoice (Question, Answer1, Answer2, Answer3, Answer4, correctAns, TestID) VALUES ('".$question."', '".$answer1."', '".$answer2."', '".$answer3."', '".$answer4."', '".$answer."', '".$testID."');";

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
