<?php
	include '../getConnection.php';
	require '../check_logged_in.php';

	$stuff = $_GET['ID'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		include '../header_container.php';
	?>
	<title>ReviseIT - Test Questions</title>
    
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
		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$stuff."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$stuff."'");
		   $resultTest2->execute();
		   echo "<form method='post' action='submiteditquestions.php?ID=".$stuff."'>";
		   $flag = 0;
		   while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='row-fluid'>";
			   echo "<div class='span10'>";
			   echo "<label for='qmc".$row['MultiChoiceID']."'>Question (Multichoice)</label>";
			   echo "<input class='input-xxlarge' name='qmc".$row['MultiChoiceID']."' id='qmc".$row['MultiChoiceID']."' type='text' value='".$row['Question']."' size='80'/></div>";
			   echo "<div class='span2'><a class='btn' href='deletemulti.php?ID=".$row['MultiChoiceID']."&TID=".$row['TestID']."'>Delete From Test</a></div></div>";	
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>A: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio' value='1'";
					if ($row['correctAns'] == "1") echo " checked='checked'";
					echo "/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmca".$row['MultiChoiceID']."' value='".$row['Answer1']."' size='80'/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>B: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio' value='2'";
					if ($row['correctAns'] == "2") echo " checked='checked'";
					echo "/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcb".$row['MultiChoiceID']."' value='".$row['Answer2']."' size='80'/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>C: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio' value='3'";
					if ($row['correctAns'] == "3") echo " checked='checked'";
					echo "/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcc".$row['MultiChoiceID']."' value='".$row['Answer3']."' size='80'/>";
			   echo "</div></div>";							
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span2'>";
			   	echo "<label class='radio'>D: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio' value='4'";
					if ($row['correctAns'] == "4") echo " checked='checked'";
					echo "/></label>";
			   echo "</div><div class='span10'>";
					echo "<input class='input-xxlarge' type='text' name='qmcd".$row['MultiChoiceID']."' value='".$row['Answer4']."' size='80'/>";
			   echo "</div>";							
			   echo "</div><br />";							
		   $flag ++;
		   } 
		   echo "<input class='btn' type='submit' name='addnewmultichoice' value='ADD NEW MULTICHOICE QUESTION' /><br /><br />";
		   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='row-fluid'>";
			   echo "<div class='span10'>";
			   echo "<label for='qtf".$row['TrueFalseID']."'>Question (True/False)</label>";
			   echo "<input class='input-xxlarge' name='qtf".$row['TrueFalseID']."' id='qtf".$row['MultiChoiceID']."' type='text' value='".$row['Question']."' size='80'/></div>";
			   echo "<div class='span2'><a class='btn' href='deletetf.php?ID=".$row['TrueFalseID']."&TID=".$row['TestID']."'>Delete From Test</a></div></div>";
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input name='radio_group".$row['TrueFalseID']."' type='radio' value='true'";
					if ($row['correctAns'] === "true") echo " checked='checked'";
					echo "/>TRUE";
				echo "</label>";
			   echo "</div></div>";
			   
			   echo "<div class='row-fluid'>";
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input name='radio_group".$row['TrueFalseID']."' type='radio' value='false'";
					if ($row['correctAns'] === "false") echo " checked='checked'";
					echo "/>FALSE";
				echo "</label>";
			   echo "</div></div><br />";
		   $flag++;
		   }
		   echo "<input class='btn' type='submit' name='addnewtruefalse' value='ADD NEW TRUE/FALSE QUESTION' /><br />";
		   if ($flag > 0) echo "<br /><input class='btn' name='submittestedit' type='submit' value='UPDATE QUESTIONS' /><br /><br />";
		   echo "</form><br /><br />"; 
			?>            
	</div>
</div>
<?php
	include '../footer.php';
?>          
</body>
</html> 