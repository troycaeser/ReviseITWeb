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
   		<div class="span12">
                    
           <?php
		   
		   $stuff = $_GET['ID']; 
		   
		   $resultTest1 = $db->prepare("SELECT * FROM multichoice WHERE TestID = '".$stuff."'");
		   $resultTest1->execute();
		   
		   $resultTest2 = $db->prepare("SELECT * FROM truefalse WHERE TestID = '".$stuff."'");
		   $resultTest2->execute();
		   while($row = $resultTest1->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='row-fluid'><div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<p>A: ";
					echo $row['Answer1'];
				echo "</p>";
			   echo "</div>";							
			   echo "<div class='span12'>";
			   	echo "<p>B: ";
					echo $row['Answer2'];
				echo "</p>";
			   echo "</div>";							
			   echo "<div class='span12'>";
			   	echo "<p>C: ";
					echo $row['Answer3'];
				echo "</p>";
			   echo "</div>";							
			   echo "<div class='span12'>";			   
			   	echo "<p>D: ";
					echo $row['Answer4'];
				echo "</p>";
			   echo "</div></div>";							
		   } 
		   while($row = $resultTest2->fetch(PDO::FETCH_ASSOC)) 
		   {
			   echo "<div class='row-fluid'><div class='span12'>Question: ".$row['Question']."</div>";	
			   
			   echo "<div class='span12'>";
			   	echo "<p>";
					echo "TRUE";
				echo "</p>";
			   echo "</div>";							
			   echo "<div class='span12'>";
			   	echo "<p>";
					echo "FALSE";
				echo "</p>";
			   echo "</div>";							
			   
			   echo "</div></div>";				
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