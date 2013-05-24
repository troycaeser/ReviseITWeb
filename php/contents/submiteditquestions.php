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
    echo $sql;
	
	$query = $db->prepare($sql);
	$query->execute(); 		
	
	echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='All the subjects' data-bootstro-content='View Test Question in Current Test.'>
		<h3>View Test Question!</h3>
		<p>View Test Questions</p>
		<a href='EditTestQuestions.php?ID=".$stuff."'>View Test</a>
	</div>";
	echo "	</div>
</div>
<?php
	include '../footer.php';
?>          
</body>
</html> ";
exit;

} elseif(isset($_POST['addnewmultichoice'])){

echo "New Multichoice";	
	
} elseif(isset($_POST['addnewtruefalse'])){

echo "New True False";	
	
} else echo "Error !";
?>
	</div>
</div>
<?php
	include '../footer.php';
?>          
</body>
</html> 