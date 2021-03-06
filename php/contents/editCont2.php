<?php
	include '../getConnection.php';
	include '../check_logged_in.php';
	include '../header_container.php';
	
	$subtopic_ID = $_GET['ID'];
?>
<!DOCTYPE html>
<html>
	<body>
		
		<?php
			include 'contents_menu_bar.php';
		?>

		<br /><br />

		<div class="container">

			<div class="page-header">
				<h1>Edit content for 
					<?php 
                        try{			
                            $result = $db->prepare("SELECT * FROM subtopic WHERE SubtopicID =:id");
                            $result->bindParam("id", $subtopic_ID);
                            $result->execute();   
                            
                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                            {
                                echo $row['SubtopicName'];
                            }
                        }
                        catch(PDOException $e)
                        {
                            echo "error";
                        }
                    ?>
        		</h1>
			</div>
			
			<div class='row-fluid'>
				<!-- Displays All subjects -->
                <div class='span8'>
                	<div class='row-fluid'>
                        <div class='span6'><h4>Content</h4></div>
                
                    <?php					
						echo "</div>";
							echo "<div class='row-fluid'>";
								echo "<div class='span6'>Data updated successfully</div>";
							echo "</div>"; 
							echo "<a href='content.php?ID=".$subtopic_ID."'>Click here to return to the content</a>";
					?>
                </div>
	<?php
	if(isset($_POST['submit']))
	{	
		date_default_timezone_set('Australia/Melbourne');
		$date = date('Y-m-d', time());
	
		$newCont = $_POST['newCont'];	
		
		//$newCont = "My Cont";
		
		if($newCont == "")
		{
			echo '<script>alert("Enter some content");</script>';
		}
		else
		{
			try
			{
				$stmt = $db->prepare("UPDATE subtopic SET Content=:newCont, DateUpdated=:date WHERE SubtopicID=:subtopic_ID");
				$stmt->bindParam("date", $date);
				$stmt->bindParam("newCont", $newCont);
				$stmt->bindParam("subtopic_ID", $subtopic_ID);
				$stmt->execute();
			}
			catch(PDOException $e)
			{
				echo "not working exceptions";
			}
		}
		
	}
	?>
				<br />
                <br />
                <br />
			</div>
		</div>
		
		<?php
			include '../footer.php';
		?>
		<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script src="../../assets/js/bootstrap.js"></script>
		<script src="../../assets/js/bootstro.min.js"></script>
		<!-- wysihtml5 parser rules -->
		<script src="../../assets/js/parser_rules/advanced.js"></script>
		<!-- Library -->
		<script src="../../assets/js/dist/wysihtml5-0.3.0.min.js"></script>
		<script src="../../assets/js/bootstrap-wysihtml5-0.0.2.js"></script>
        <script>
		function imo()
		{
			alert("runnin");
			$('#newCont').val();
		}
        </script>
        <script>
			var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
			  toolbar:      "wysihtml5-toolbar", // id of toolbar element
			  parserRules:  wysihtml5ParserRules // defined in parser rules set 
			});
		</script>
		<script type="text/javascript">
			$('.textarea').wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": false //Button to change color of font  
			});
		</script>
	</body>
</html>