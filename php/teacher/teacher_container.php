<?php

	include '../getConnection.php';

	if($_SESSION['Role'] == 2){
		echo "<div class='row-fluid'>";
			echo "<div class='span6'>";
				echo "<h3>See All Subjects!</h3>";
				echo "<p>See your subjects and upload some contents!</p>";
				echo "<a href='../subjects/all_Subjects.php' class='btn btn-primary'>All Subjects</a>";
			echo "</div>";
			echo "<div class='span6'>";
				echo "<h3>Enrol a student</h3>";
				echo "<p>Enrol a student into one of your subjects.</p>";
				echo "<a href='../subjects/enrol_subject.php' class='btn btn-primary'>Enrol a student</a>";
			echo "</div>";
		echo "</div>";
	}
	else if($_SESSION['Role'] == 3){
		echo "<div class='row-fluid'>";
			echo "<div class='span12'>";
				echo "<h3>See All Subjects!</h3>";
				echo "<p>See your subjects and upload some contents!</p>";
				echo "<a href='../subjects/all_Subjects.php' class='btn btn-primary'>All Subjects</a>";
			echo "</div>";
		echo "</div>";
	}
?>