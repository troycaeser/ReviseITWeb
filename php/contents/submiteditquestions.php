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
		
	$sql = $sql."UPDATE multichoice SET Question = '".$question."', Answer1 = '".$answer1."', Answer2 = '".$answer2."', Answer3 = '".$answer3."', Answer4 = '".$answer4."', correctAns = '".$answer."' WHERE MultiChoiceID = ".$mcid."; ";
}

		   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
{
	$tfid = $row['TrueFalseID'];

	$name = "qtf".$tfid;
	$namevalue = "radio_group".$tfid;
	
	$question = $_POST[$name];
	$answer = $_POST[$namevalue];		
	
	$sql = $sql."UPDATE truefalse SET Question = '".$question."', correctAns = '".$answer."' WHERE TrueFalseID = ".$tfid."; ";
}
	
	$query = $db->prepare($sql);
	$query->execute(); 		
	
	echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Edit Test Questions' data-bootstro-content='View Test Question in Current Test.'>
		<h3>Edit Test Question!</h3>
		<p>Edit Test Questions</p>
		<a href='EditTestQuestions.php?ID=".$stuff."'>View Test</a>
	</div>";
	echo "	</div>
</div>
	include '../footer.php';         
</body>
</html> ";
exit;

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