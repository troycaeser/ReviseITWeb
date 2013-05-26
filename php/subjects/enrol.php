<?php
	ob_start();
	include '../getConnection.php';

	if(isset($_POST['submit_enrol'])){

		//grabs basic details.
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$userName = $_POST['userName'];
		$subjectID = $_POST['subject'];

		//get the userID using these 3 credentials.
		$result = $db->prepare("SELECT UserID FROM users WHERE fName = :bind_fName AND lName = :bind_lName AND username = :bind_userName");
		$result->bindParam("bind_fName", $firstName);
		$result->bindParam("bind_lName", $lastName);
		$result->bindParam("bind_userName", $userName);
		$result->execute();

		$userID = $result->fetchColumn();

		//check if user is already enrolled.
		$check_enrol_query = $db->prepare("SELECT * FROM usersubject WHERE UserID = :bind_userID AND SubjectID = :bind_SubjectID");
		$check_enrol_query->bindParam("bind_userID", $userID);
		$check_enrol_query->bindParam("bind_SubjectID", $subjectID);
		$check_enrol_query->execute();

		//count if there's any result with the matching enrolment details.
		$check_enrol = $check_enrol_query->rowCount();

		if((!empty($subjectID))){
			//if check_enrol is less than one, that means there's this user and subject are not bounded therefore
			//proceed with enrolment, otherwise, display error message.
			if($check_enrol < 1){
				//enrol student.
				$enrol_query = $db->prepare("INSERT INTO usersubject VALUES(:bind_userID, :bind_subjectID)");
				$enrol_query->bindParam("bind_userID", $userID);
				$enrol_query->bindParam("bind_subjectID", $subjectID);
				$enrol_query->execute();

				header("Location: enrol_success.php");
			}else{
				header("Location: enrol_fail.php");
			}
		}
		else{
			echo "<link rel='stylesheet' href='../../assets/css/version1.css'>";
			echo "<link rel='stylesheet' href='../../assets/css/bootstrap-responsive.css'>";
			echo "<div class='alert alert-error'>You have not yet selected a subject to enrol in!</div>";

			exit(header( "refresh:2; url=enrol_subject.php" ));
			ob_get_flush();
		}
	}
?>