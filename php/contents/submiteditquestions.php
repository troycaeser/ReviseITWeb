<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	require '../../DAL/Verification.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
		include '../header_container.php';
	?>
<title>ReviseIT - Edit Test Questions</title>
</head>
<body>
<?php
		include '../subtopics/subtopics_menu_bar.php';
	?>
<div class="container">
  <div class="page-header">
    <h1>Edit Test Questions</h1>
  </div>
  <?php 

		   $stuff = $_GET["ID"];

if(isset($_POST['submittestedit'])){

		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$stuff."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$stuff."'");
		   $resultTest2->execute();
		   
	$error = 0;
			$sql ="";
		   while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
{
	$mcid = $row['MultiChoiceID'];

	$name = "qmc".$mcid;
	$namea = "qmca".$mcid;
	$nameb = "qmcb".$mcid;
	$namec = "qmcc".$mcid;
	$named = "qmcd".$mcid;
	$namevalue = "rdo_group".$mcid;
	
	$question = $_POST[$name];
	$answer1 = $_POST[$namea];		
	$answer2 = $_POST[$nameb];		
	$answer3 = $_POST[$namec];		
	$answer4 = $_POST[$named];
	$answer = $_POST[$namevalue];

	$processed_question = str_replace(array('\"'), array('\\\"'), $question);
	$processed_answer1 = str_replace(array('\"'), array('\\\"'), $answer1);
	$processed_answer2 = str_replace(array('\"'), array('\\\"'), $answer2);
	$processed_answer3 = str_replace(array('\"'), array('\\\"'), $answer3);
	$processed_answer4 = str_replace(array('\"'), array('\\\"'), $answer4);
	$processed_answer = str_replace(array('\"'), array('\\\"'), $answer);
	
	if (($question == "") || ($answer1 == "") || ($answer2 == "") || ($answer3 == "") || ($answer4 == "")) $error = 1;
	
	else
	$sql = $sql."UPDATE multichoice SET Question = '".$processed_question."', Answer1 = '".$processed_answer1."', Answer2 = '".$processed_answer2."', Answer3 = '".$processed_answer3."', Answer4 = '".$processed_answer4."', correctAns = '".$processed_answer."' WHERE MultiChoiceID = ".$mcid."; ";
}
	if ($error == 0){
			   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		{
	$tfid = $row['TrueFalseID'];

	$name = "qtf".$tfid;
	$namevalue = "radio_group".$tfid;
	
	$question = $_POST[$name];
	$answer = $_POST[$namevalue];		

	if ($question == "") $error = 1;
	
	else	
	$sql = $sql."UPDATE truefalse SET Question = '".$question."', correctAns = '".$answer."' WHERE TrueFalseID = ".$tfid."; ";
		}
	}
	if ($error == 0) {
	$query = $db->prepare($sql);
	$query->execute(); 		
	
	echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit Test Questions' data-bootstro-content='View Test Question in Current Test.'>
		<h3>Upgraded Test Questions!</h3>
		<p>Edit Test Questions</p>
		<a href='EditTestQuestions.php?ID=".$stuff."'>View Test</a>
	</div>";
	echo "	</div>
</div>";
	include '../footer.php';         
echo "</body>
</html> ";
exit; 
		}
		else {
			echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit Test Questions' data-bootstro-content='View Test Question in Current Test.'>
		<h3>Your Questions have Blank Fields, Please Correct Them!</h3>
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
} elseif(isset($_POST['addnewmultichoice'])){
		echo "<form method='post' action='addnewmulti.php?ID=".$stuff."'>";
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   echo "<label for='qmc'>Question (Multichoice)</label>";
			   echo "<input class='input-xxlarge' name='qmc' id='qmc' type='text' value=''/></div></div>";	
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>A: ";
					echo "<input name='rdo_group' type='radio' value='1'/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmca' value=''/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>B: ";
					echo "<input name='rdo_group' type='radio' value='2'/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcb' value=''/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>C: ";
					echo "<input name='rdo_group' type='radio' value='3'/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcc' value='' size='80'/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>D: ";
					echo "<input name='rdo_group' type='radio' value='4'/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcd' value=''/>";
			   echo "</div>";							
			   echo "</div><br />";
			   echo "<input class='btn' type='submit' name='addnewmulti' value='ADD QUESTION TO TEST' />";
		echo "</form>";			   							
	
} elseif(isset($_POST['addnewtruefalse'])){
	
	echo "<form method='post' action='addnewtf.php?ID=".$stuff."'>";
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   echo "<label for='qtf'>Question (True/False)</label>";
			   echo "<input class='input-xxlarge' name='qtf' id='qtf' type='text' value='' size='80'/></div></div>";
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input name='radio_group' type='radio' value='true'/>TRUE";
				echo "</label>";
			   echo "</div></div>";
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input name='radio_group' type='radio' value='false'/>FALSE";
				echo "</label>";
			   echo "</div></div><br />";
			   echo "<input class='btn' type='submit' name='addnewtf' value='ADD QUESTION TO TEST' />";
			   echo "</form>";
	
} else echo "Error !";
?>
</div>
</div>
<?php
	include '../footer.php';
?>
</body>
</html>
