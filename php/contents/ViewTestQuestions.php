<?php
	include '../getConnection.php';
	require '../check_logged_in.php';

	$SubtopicID = $_GET['ID'];
	
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
		   //$query = $db->prepare("SELECT TestID FROM subtopic WHERE SubtopicID = :subtop_ID");
		   //$query->bindParam("subtop_ID", $SubtopicID);
		   //$query->execute();
		   //$stuff = $query->fetchColumn();
		   
		   $stuff = 2; //remove when database is working
		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$stuff."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$stuff."'");
		   $resultTest2->execute();
		   while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>A: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer1'];
				echo "</label>";
			   
			   	echo "<label class='radio'>B: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer2'];
				echo "</label>";
			   
			   	echo "<label class='radio'>C: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer3'];
				echo "</label>";
			   
			   	echo "<label class='radio'>D: ";
					echo "<input name='rdo_group".$row['MultiChoiceID']."' type='radio'/>".$row['Answer4'];
				echo "</label>";
			   echo "</div>";							
		   } 
		   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<label class='radio'>";
					echo "<input name='radio_group".$row['TrueFalseID']."' type='radio'/>TRUE";
				echo "</label>";
			   
			   	echo "<label class='radio'>";
					echo "<input name='radio_group".$row['TrueFalseID']."' type='radio'/>FALSE";
				echo "</label>";
			   
			   echo "</div>";				
		   } 
			?>            
		</div>
	</div>
</div>
<?php
	include '../footer.php';
?>          
</body>
</html> 