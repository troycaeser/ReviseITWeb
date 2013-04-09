<?php

	include 'getConnection.php'; 

	//reminder: $_SESSION['UserID'] still exists on this page, but will be removed after.
	session_destroy();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="refresh" content="3;URL=../index.php">
		<title>Logging out...</title>
		<link rel="stylesheet" href="../assets/css/version1.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.css">
	</head>
	<body>
		<div class="container">
			<p class="text-center">You have logged out!</p>
			<p class="text-center">Directing to logging page in 3 seconds...</p>
		</div>
	</body>
</html>