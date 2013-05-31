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
	
	$TestID = $_GET['ID'];	  

if(isset($_POST['submitTest'])){

		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$TestID."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$TestID."'");
		   $resultTest2->execute();
		   
	$correct = 0;
	$max = 0;
	$arrCorr = NULL;
	$arrAns = NULL;
	$arrCorrAns = NULL;
	$arrQuest = NULL;

	while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
{
	$mcid = $row['MultiChoiceID'];
	$namevalue = "rdo_group".$mcid;	
	$answer = $_POST[$namevalue];
		
	if ($answer = $row['correctAns']) {
		$correct++;
		$arrCorr[$max] = 'true';  
		} else {
			$arrCorr[$max] = 'false';
			$arrAns[$max] = $answer;
			$tempCol = "Answer" . $row['correctAns'];
			$arrCorrAns[$max] = $Row[$tempCol];
			$arrQuest = $row['Question'];
		}
	
	$max++;
	
}
	$arr2Corr = NULL;
	$arr2Ans = NULL;
	$arr2Quest = NULL;
	
	while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		{
	$tfid = $row['TrueFalseID'];

	$name = "qtf".$tfid;
	$namevalue = "radio_group".$tfid;
	$answer = $_POST[$namevalue];		
	if ($answer = $row['correctAns']) {
		$correct++;
		$arr2Corr[$max] = 'true';  
		} else {
			$arr2Corr[$max] = 'false';
			$arr2Ans[$max] = $answer;
			$arrQuest = $row['Question'];
		}
	
	$max++;
	}

	$score = $correct / $max * 100;
	
	echo"<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Test Score Questions' data-bootstro-content='View Result for Questions in Current Test.'>
		<h3>Corrected Test Questions!</h3>
		<p>Test Result: %".$score;
	
	for ($i = 0; $i < $arrCorr.length; $i++){
		if ($arrCorr[i] != 'true'){
			echo "<br /><p>Question: ".$arrQuest[i];
			echo "</p><p>Your Answer: ".$arrAns[i];
			echo "</p><p>Correct Answer: ".$arrCorrAns[i];
			echo "</p>";
			}
		}

	for ($i = 0; $i < $arr2Corr.length; $i++){
		if ($arrCorr[i] != 'true'){
			echo "<br /><p>Question: ".$arr2Quest[i];
			echo "</p><p>Your Answer: ".$arr2Ans[i];
			echo "</p><p>Correct Answer: ";
			if($arrAns[i] === 'true') echo "false";
			else echo "true";
			echo "</p>";
			}
		}
	if ($arrCorr.length == 0 || $arr2Corr.length == 0) echo "<br /><h3>Congratulations: Perfect Result!</h3><br />";
	}
?>
	<div class='row-fluid'>
	<div class='span4 bootstro' data-bootstro-placement='bottom' data-bootstro-title='Return to Home Page' data-bootstro-content='Return to Home Page.'>
		<h3>Home Page</h3>
		<p>Click To Return To Home Page!</p>
        <a href="../student/studentHome.php">Click Here<a><br /><br />
</div>
</div>
<?php
	include '../footer.php';
?>
</body>
</html>
