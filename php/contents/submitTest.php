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
<title>ReviseIT - Correct Test Questions</title>
</head>
<body>
<?php
		include '../subtopics/subtopics_menu_bar.php';
	?>
<div class="container">
  <div class="page-header">
    <h1>Correct Test Questions</h1>
  </div>
  <?php 
	
	$TestID = $_GET['ID'];	
		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$TestID."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$TestID."'");
		   $resultTest2->execute();
		   
	$correct = 0;
	$max = 0;
	$flag = 0;

	while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
{
	$mcid = $row['MultiChoiceID'];
	$namevalue = "rdo_group".$mcid;	
	$answer = $_POST[$namevalue];
	if ($answer < 1 || $answer == NULL){
		$answerStr = "None"; 
	} else {
		$answerInt = "Answer".$answer;
		$answerStr = $row[$answerInt];
	}
		$correctAns = "Answer".$row['correctAns'];
		$correctStr = $row[$correctAns];

// echo '$mcid = '.$mcid.', $namevalue = '.$namevalue.', $answer = '.$answer.', $answerStr = '.$answerStr.', $correctAns = '.$correctAns.', $correctStr = '.$correctStr.'<br />';
		
	if ($answerStr == $correctStr) {
		$correct++; 
	} else {
		if ($flag == 0) echo "<h3>You answered the following questions incorrectly</h3>"; 
		echo "<br /><p>Question: ".$row['Question'];
		echo "</p><p>Your Answer: ".$answerStr;
		echo "</p><p>Correct Answer: ".$correctStr;
		echo "</p>";
		 $flag++;
	}	
	
	$max++;
	
}
	
	while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		{
	$tfid = $row['TrueFalseID'];
	$namevalue = "radio_group".$tfid;
	$answer = $_POST[$namevalue];
	$answerStr = 'none';
	if ($answer == 'false') $answerStr = 'false';
	if ($answer == 'true') $answerStr = 'true';
			
	if ($answerStr == $row['correctAns']) {
		$correct++;
		} else {
		if ($flag == 0) echo "<h3>You answered the following questions incorrectly</h3>"; 
		echo "<br /><p>Question: ".$row['Question'];
		echo "</p><p>Your Answer: ".$answerStr;
		echo "</p><p>Correct Answer: ".$row['correctAns'];
		echo "</p>";
		 $flag++;
		 }
	
	$max++;
	}

	$score = (int) $correct / $max * 100;
	
	$sql = $db->prepare("SELECT * FROM results WHERE TestID = '".$TestID."' AND UserID = '".$_SESSION['UserID']."';");
		   $sql->execute();
		   if ($row = $sql->fetch(PDO::FETCH_OBJ)){
			   	$sql = $db->prepare("UPDATE results SET Result = ".$score." WHERE TestID = '".$TestID."' AND UserID = '".$_SESSION['UserID']."';");
		   		$sql->execute();
		   } else {
				$sql = $db->prepare("INSERT INTO results (Result, TestID,  UserID) VALUES (".$score.", ".$TestID.", ".$_SESSION['UserID'].");");
		   		$sql->execute();  
		   }
		   
		   
	echo"<div class='row-fluid'>
	<div class='span12 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Test Score Questions' data-bootstro-content='View Result for Questions in Current Test.'>
		<h3>Corrected Test Questions!</h3>
		<p>Test Result: ".$score."%";
				
	if ($max == $correct) echo "<br /><br /><h3>Congratulations: Perfect Result!</h3><br />";
	else echo "<br /><br /><h3>Sorry: You answered $flag questions incorrectly!</h3><br />";

?>
  <div class='row-fluid'>
    <div class='span8 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Return to Home Page' data-bootstro-content='Return to Home Page.'>
      <h3>Home Page</h3>
      <p>Click To Return To Home Page!</p>
      <a href="../home_page_director.php">Click Here<a><br />
      <br />
    </div>
  </div>
</div>
<?php
	include '../footer.php';
?>
</body>
</html>
