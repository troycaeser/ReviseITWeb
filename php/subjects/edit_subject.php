
<!doctype html>
<html lang="en">
		<link rel="stylesheet" href="../../assets/css/version1.css">
		<link rel="stylesheet" href="../../assets/css/bootstrap-responsive.css">

	<body>
		<?php

			include '../getConnection.php';
			require '../check_logged_in.php';

			if(isset($_POST['update_submit'])){
				
				$subjectID 		= 	$_GET['ID'];
				$subjectName 	= 	$_POST['subject_name'.$_GET['ID']];
				$subjectCode 	= 	$_POST['subject_code'.$_GET['ID']];
				$selectedUser 	= 	$_POST['subject_coordinator'.$_GET['ID']];

				//get the date in Australia and assign variable
				date_default_timezone_set('Australia/Melbourne');
				$date = date('Y-m-d', time());

				if($_SESSION['Role'] == 1){
					//if these fields are not empty, execute and update.
					if((!empty($subjectName)) && (!empty($subjectCode)) && (!empty($selectedUser)) ){
						$query_update_string = $db->prepare("UPDATE subject SET SubjectID = :bind_SubjectID, SubjectCode = :bind_SubjectCode, SubjectName = :bind_SubjectName, UserID = :bind_UserID, Dateupdated = :bind_Date WHERE SubjectID = :bind_SubjectID");
						$query_update_string->bindParam("bind_SubjectID", $subjectID);
						$query_update_string->bindParam("bind_SubjectCode", $subjectCode);
						$query_update_string->bindParam("bind_SubjectName", $subjectName);
						$query_update_string->bindParam("bind_UserID", $selectedUser);
						$query_update_string->bindParam("bind_Date", $date);
						$query_update_string->execute();

						header("Location: all_Subjects.php");
					}
					else{
						echo "<div class='alert alert-error'>make sure you have all of your fields filled in and selected.</div>";

						header( "refresh:2; url=all_Subjects.php" );
					}
				}
				else if($_SESSION['Role'] == 2){
					//if these fields are not empty, execute and update.
					if((!empty($subjectName)) && (!empty($subjectCode)) ){
						$query_update_string = $db->prepare("UPDATE subject SET SubjectID = :bind_SubjectID, SubjectCode = :bind_SubjectCode, SubjectName = :bind_SubjectName, UserID = :bind_UserID, Dateupdated = :bind_Date WHERE SubjectID = :bind_SubjectID");
						$query_update_string->bindParam("bind_SubjectID", $subjectID);
						$query_update_string->bindParam("bind_SubjectCode", $subjectCode);
						$query_update_string->bindParam("bind_SubjectName", $subjectName);
						$query_update_string->bindParam("bind_UserID", $selectedUser);
						$query_update_string->bindParam("bind_Date", $date);
						$query_update_string->execute();

						header("Location: all_Subjects.php");
					}
					else{
						echo "<div class='alert alert-error'>make sure you have all of your fields filled in and selected.</div>";

						header( "refresh:2; url=all_Subjects.php" );
					}
				}
			}
		?>
	</body>
</html>