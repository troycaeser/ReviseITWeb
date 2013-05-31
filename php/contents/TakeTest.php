<?php
	include '../getConnection.php';
	require '../check_logged_in.php';

	$TestID = $_GET['ID'];
	
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
        <h1>Test Questions</h1>
    </div>
 
	<div class="row-fluid">
   		<div class="span8">
                    
           <?php
		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$TestID."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$TestID."'");
		   $resultTest2->execute();
		   
		   echo "<form action='submitTest.php?ID=".$TestID."' method='post'>";
		   while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>A: ";
					echo "<input value='1' name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer1'];
				echo "</label>";
			   
			   	echo "<label class='radio'>B: ";
					echo "<input value='2' name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer2'];
				echo "</label>";
			   
			   	echo "<label class='radio'>C: ";
					echo "<input value='3' name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer3'];
				echo "</label>";
			   
			   	echo "<label class='radio'>D: ";
					echo "<input value='4' name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer4'];
				echo "</label>";
			   echo "</div>";							
		   } 
		   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input value='true' name='radio_group".$row['TrueFalseID']."' type='radio'/>TRUE";
				echo "</label>";
			   
			   	echo "<label class='radio'>";
					echo "<input value='false' name='radio_group".$row['TrueFalseID']."' type='radio'/>FALSE";
				echo "</label>";
			   
			   echo "</div>";				
		   }
		   echo "<br /><input class='btn' type='submit' value='SUBMIT TEST' name='submitTest' /><br /><br />";
		   echo "</form>"; 
			?>            
		</div>
	</div>
</div>
<?php
	include '../footer.php';
?>          
</body>
</html> 